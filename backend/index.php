<?php
// backend/index.php

// Enable CORS for all requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Set content type to JSON
header('Content-Type: application/json');

// Define API routes
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Check if request is for API
if (strpos($request_uri, '/api/') === 0) {
    $path = substr($request_uri, strlen('/api'));
    
    // Route to appropriate handler
    if ($path === '/ask' && $request_method === 'POST') {
        require_once __DIR__ . '/api/ask.php';
        exit;
    } else {
        // 404 Not Found
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        exit;
    }
} else {
    // Serve static files from public directory if not API request
    $requested_file = __DIR__ . '/../public' . $request_uri;
    if (file_exists($requested_file) && !is_dir($requested_file)) {
        // Serve the static file
        $extension = pathinfo($requested_file, PATHINFO_EXTENSION);
        $mime_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'png' => 'image/png',
            'jpg' => 'image/jpg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
            'html' => 'text/html',
            'txt' => 'text/plain'
        ];
        
        if (isset($mime_types[$extension])) {
            header('Content-Type: ' . $mime_types[$extension]);
        }
        readfile($requested_file);
        exit;
    } else {
        // If no static file found, serve index.html for SPA
        header('Content-Type: text/html');
        if (file_exists(__DIR__ . '/../public/index.html')) {
            readfile(__DIR__ . '/../public/index.html');
        } else {
            echo '<h1>Welcome to AI-Powered Portfolio Backend</h1>';
        }
        exit;
    }
}
?>
