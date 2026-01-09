<?php
// backend/config/gemini.php

// Load environment variables
if (file_exists(__DIR__ . '/../.env')) {
     = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ( as ) {
        if (strpos(trim(), '#') === 0) {
            continue; // Skip comments
        }
        list(, ) = explode('=', , 2);
         = trim();
         = trim();
        if (!empty()) {
            [] = ;
            putenv(\"{}={}\");
        }
    }
}

// Get Gemini API key from environment variable
define('GEMINI_API_KEY', ['GEMINI_API_KEY'] ?? getenv('GEMINI_API_KEY') ?? '');

if (empty(GEMINI_API_KEY)) {
    error_log('GEMINI_API_KEY is not set. Please set it as an environment variable.');
}
?>
