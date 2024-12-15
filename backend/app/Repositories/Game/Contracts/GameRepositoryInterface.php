<?php

namespace App\Repositories\Game\Contracts;

use App\Models\Game;

interface GameRepositoryInterface
{
    public function getCurrentGame(): Game;
    public function addExtractedNumber(Game $game, int $number): void;
}