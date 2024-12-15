<?php

namespace App\Services\Game;

class WinConditionService
{
    private const CONDITIONS = [
        'ambo' => 2,
        'terno' => 3,
        'quaterna' => 4,
        'cinquina' => 5,
        'tombola' => 15
    ];

    public function getRequiredMatches(string $winType): int
    {
        return self::CONDITIONS[$winType] ?? throw new \InvalidArgumentException('Invalid win type');
    }

    public function isValidWinType(string $winType): bool
    {
        return isset(self::CONDITIONS[$winType]);
    }
}