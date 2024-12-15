<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \App\Http\Middleware\CorsMiddleware::class,  // Usa solo il middleware personalizzato per i CORS
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Illuminate\Session\Middleware\StartSession::class,
    ];

    protected $middlewareGroups = [
        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\CorsMiddleware::class,  // Usa il middleware personalizzato anche per le API
        ],
    ];

    protected $middlewareAliases = [
        'cors' => \App\Http\Middleware\CorsMiddleware::class,  // Alias per il middleware personalizzato
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
