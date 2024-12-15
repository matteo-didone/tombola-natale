<?php

namespace App\Services\Game;

class NumberGenerator
{
    public function generate(array $excludedNumbers): int
    {
        $availableNumbers = array_diff(range(1, 90), $excludedNumbers);
        
        if (empty($availableNumbers)) {
            throw new \RuntimeException('All numbers have been extracted');
        }
        
        return $availableNumbers[array_rand($availableNumbers)];
    }
}