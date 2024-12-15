<?php

namespace App\Services\Game\Validators;

use App\Exceptions\GameException;

class WinValidator
{
    private const WIN_CONDITIONS = [
        'ambo' => 2,
        'terno' => 3,
        'quaterna' => 4,
        'cinquina' => 5,
        'tombola' => 15
    ];

    public function validate(string $winType): void
    {
        if (!isset(self::WIN_CONDITIONS[$winType])) {
            throw GameException::invalidWinType($winType);
        }
    }

    public function getRequiredMatches(string $winType): int
    {
        return self::WIN_CONDITIONS[$winType];
    }

    public function checkWinCondition(array $cardNumbers, array $extractedNumbers, string $winType): bool
    {
        $matches = array_intersect($cardNumbers, $extractedNumbers);
        return count($matches) >= $this->getRequiredMatches($winType);
    }
}