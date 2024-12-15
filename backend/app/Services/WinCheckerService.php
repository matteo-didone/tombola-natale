<?php

namespace App\Services;

class WinCheckerService
{
    public function flattenCardNumbers(array $rows): array
    {
        $numbers = [];
        foreach ($rows as $row) {
            $numbers = array_merge($numbers, $row);
        }
        return $numbers;
    }

    public function checkWin(array $cardNumbers, array $extractedNumbers, string $winType): bool
    {
        $matches = array_intersect($cardNumbers, $extractedNumbers);

        return match ($winType) {
            'ambo' => count($matches) >= 2,
            'terno' => count($matches) >= 3,
            'quaterna' => count($matches) >= 4,
            'cinquina' => count($matches) >= 5,
            'tombola' => count($matches) === count($cardNumbers),
            default => false,
        };
    }
}
