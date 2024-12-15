<?php

namespace App\Services;

class WinCheckerService
{
    private const WIN_CONDITIONS = [
        'ambo' => 2,
        'terno' => 3,
        'quaterna' => 4,
        'cinquina' => 5,
        'tombola' => 15
    ];

    public function checkWin(array $cardNumbers, array $extractedNumbers, string $winType): bool
    {
        $matches = array_intersect($cardNumbers, $extractedNumbers);
        return count($matches) >= self::WIN_CONDITIONS[$winType];
    }

    public function flattenCardNumbers(array $rows): array
    {
        return array_merge(...$rows);
    }
}