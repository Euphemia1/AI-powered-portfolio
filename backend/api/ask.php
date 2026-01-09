<?php
// backend/api/ask.php

require_once __DIR__ . '/../config/gemini.php';

// Set content type to JSON
header('Content-Type: application/json');

// Handle only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get the input data
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['prompt']) || empty(trim($input['prompt']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Prompt is required']);
    exit;
}

$prompt = trim($input['prompt']);

// Validate Gemini API key
if (empty(GEMINI_API_KEY)) {
    http_response_code(500);
    echo json_encode(['error' => 'Gemini API key is not configured']);
    exit;
}

try {
    // Prepare the request to Gemini API
    $geminiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . GEMINI_API_KEY;
    
    $postData = [
        'contents' => [
            'parts' => [
                [
                    'text' => $prompt . ' Please provide a concise, helpful response related to the developer portfolio.'
                ]
            ]
        ]
    ];
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $geminiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 30 second timeout
    
    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    if ($error) {
        throw new Exception('cURL Error: ' . $error);
    }
    
    if ($httpCode !== 200) {
        throw new Exception('API request failed with HTTP code: ' . $httpCode . ', Response: ' . $response);
    }
    
    // Parse the response from Gemini
    $responseData = json_decode($response, true);
    
    if ($responseData === null) {
        throw new Exception('Invalid JSON response from Gemini API');
    }
    
    // Extract the text response
    $textResponse = '';
    if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
        $textResponse = $responseData['candidates'][0]['content']['parts'][0]['text'];
    } else {
        // If no candidates found, try to get the error details
        if (isset($responseData['error'])) {
            throw new Exception('Gemini API Error: ' . $responseData['error']['message']);
        } else {
            throw new Exception('Could not extract response from Gemini API');
        }
    }
    
    // Return the response
    echo json_encode([
        'success' => true,
        'response' => $textResponse,
        'prompt' => $prompt
    ]);
    
} catch (Exception $e) {
    // Log the error for debugging
    error_log('Gemini API Error: ' . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'error' => 'An error occurred while processing your request',
        'details' => $e->getMessage()
    ]);
}?>
?>
