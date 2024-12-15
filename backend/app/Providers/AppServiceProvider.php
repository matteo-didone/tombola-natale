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
        // Ensure the default view paths are correctly set
        \Illuminate\Support\Facades\View::addLocation(resource_path('views'));
    }
}
