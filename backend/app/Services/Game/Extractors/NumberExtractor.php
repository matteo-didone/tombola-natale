<?php

namespace App\Services\Game\Extractors;

use App\Exceptions\GameException;

class NumberExtractor
{
    public function extract(array $excludedNumbers): int
    {
        $availableNumbers = array_diff(range(1, 90), $excludedNumbers);
        
        if (empty($availableNumbers)) {
            throw GameException::allNumbersExtracted();
        }
        
        return $availableNumbers[array_rand($availableNumbers)];
    }
}