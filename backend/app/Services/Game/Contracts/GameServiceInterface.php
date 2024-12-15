<?php

namespace App\Services\Game\Contracts;

interface GameServiceInterface
{
    public function extractNumber(): int;
    public function getCurrentGame();
    public function checkWin(string $playerId, string $winType): bool;
}