<?php
// backend/config/gemini.php

// Load environment variables
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!empty($key)) {
            $_ENV[$key] = $value;
            putenv("{$key}={$value}");
        }
    }
}

// Get Gemini API key from environment variable
define('GEMINI_API_KEY', $_ENV['GEMINI_API_KEY'] ?? getenv('GEMINI_API_KEY') ?? '');

if (empty(GEMINI_API_KEY)) {
    error_log('GEMINI_API_KEY is not set. Please set it as an environment variable.');
}
?>
