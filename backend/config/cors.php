<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration controls the Cross-Origin Resource Sharing (CORS)
    | settings for your application. Adjust these settings based on your
    | application's requirements.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Allow all methods (GET, POST, PUT, DELETE, etc.)
    'allowed_methods' => ['*'],

    // Allow specific origins from the FRONTEND_URL environment variable
    'allowed_origins' => array_filter(
        explode(',', env('FRONTEND_URL', 'http://localhost:5173'))
    ),

    // No patterns for allowed origins
    'allowed_origins_patterns' => [],

    // Allow all headers
    'allowed_headers' => ['*'],

    // Exposed headers (none in this case)
    'exposed_headers' => [],

    // Cache preflight requests for 24 hours
    'max_age' => 86400,

    // Allow cookies and other credentials
    'supports_credentials' => true,
];
