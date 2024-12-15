<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Game\Contracts\GameServiceInterface;
use App\Services\Game\GameService;
use App\Repositories\Game\Contracts\GameRepositoryInterface;
use App\Repositories\Game\GameRepository;

class GameServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GameServiceInterface::class, GameService::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }
}