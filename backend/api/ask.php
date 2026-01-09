<?php
// backend/api/ask.php

require_once __DIR__ . '/../config/gemini.php';

// Set content type to JSON
header('Content-Type: application/json');

// Handle only POST requests
if (['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get the input data
\ = json_decode(file_get_contents('php://input'), true);

if (!isset(\['prompt']) || empty(trim(\['prompt']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Prompt is required']);
    exit;
}

\ = trim(\['prompt']);

// Validate Gemini API key
if (empty(GEMINI_API_KEY)) {
    http_response_code(500);
    echo json_encode(['error' => 'Gemini API key is not configured']);
    exit;
}

try {
    // Prepare the request to Gemini API
    \ = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . GEMINI_API_KEY;
    
    \ = [
        'contents' => [
            'parts' => [
                [
                    'text' => \ . ' Please provide a concise, helpful response related to the developer portfolio.'
                ]
            ]
        ]
    ];
    
    // Initialize cURL
    \ = curl_init();
    curl_setopt(\, CURLOPT_URL, \);
    curl_setopt(\, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(\, CURLOPT_POST, true);
    curl_setopt(\, CURLOPT_POSTFIELDS, json_encode(\));
    curl_setopt(\, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt(\, CURLOPT_TIMEOUT, 30); // 30 second timeout
    
    // Execute the request
    \ = curl_exec(\);
    \ = curl_getinfo(\, CURLINFO_HTTP_CODE);
    \Cannot convert 'System.Object[]' to the type 'System.String' required by parameter 'Name'. Specified method is not supported. A positional parameter cannot be found that accepts argument 'backend'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. = curl_error(\);
    
    curl_close(\);
    
    if (\Cannot convert 'System.Object[]' to the type 'System.String' required by parameter 'Name'. Specified method is not supported. A positional parameter cannot be found that accepts argument 'backend'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'.) {
        throw new Exception('cURL Error: ' . \Cannot convert 'System.Object[]' to the type 'System.String' required by parameter 'Name'. Specified method is not supported. A positional parameter cannot be found that accepts argument 'backend'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'.);
    }
    
    if (\ !== 200) {
        throw new Exception('API request failed with HTTP code: ' . \ . ', Response: ' . \);
    }
    
    // Parse the response from Gemini
    \ = json_decode(\, true);
    
    if (\ === null) {
        throw new Exception('Invalid JSON response from Gemini API');
    }
    
    // Extract the text response
    \ = '';
    if (isset(\['candidates'][0]['content']['parts'][0]['text'])) {
        \ = \['candidates'][0]['content']['parts'][0]['text'];
    } else {
        // If no candidates found, try to get the error details
        if (isset(\['error'])) {
            throw new Exception('Gemini API Error: ' . \['error']['message']);
        } else {
            throw new Exception('Could not extract response from Gemini API');
        }
    }
    
    // Return the response
    echo json_encode([
        'success' => true,
        'response' => \,
        'prompt' => \
    ]);
    
} catch (Exception \) {
    // Log the error for debugging
    error_log('Gemini API Error: ' . \->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'error' => 'An error occurred while processing your request',
        'details' => \->getMessage()
    ]);
}
?>
