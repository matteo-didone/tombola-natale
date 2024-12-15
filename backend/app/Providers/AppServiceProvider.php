<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Game\Contracts\GameServiceInterface;
use App\Services\Game\GameService;
use App\Repositories\Game\Contracts\GameRepositoryInterface;
use App\Repositories\Game\GameRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interfaces to implementations
        $this->app->bind(GameServiceInterface::class, GameService::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }

    public function boot(): void
    {
        // Configure CORS headers for all responses
        response()->macro('cors', function ($response) {
            $origin = request()->header('Origin');
            $allowedOrigins = config('cors.allowed_origins', []);

            if (in_array($origin, $allowedOrigins)) {
                $response->headers->set('Access-Control-Allow-Origin', $origin);
                $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
                $response->headers->set('Access-Control-Max-Age', '86400');
            }

            return $response;
        });
    }
}