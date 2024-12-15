<?php

namespace App\Services\Card;

class CardGenerator
{
    public function generateRows(): array
    {
        $rows = [];
        $usedNumbers = [];
        
        for ($i = 0; $i < 3; $i++) {
            $row = $this->generateRow($usedNumbers);
            sort($row);
            $rows[] = $row;
        }
        
        return $rows;
    }
    
    private function generateRow(array &$usedNumbers): array
    {
        $row = [];
        while (count($row) < 5) {
            $number = rand(1, 90);
            if (!in_array($number, $usedNumbers)) {
                $row[] = $number;
                $usedNumbers[] = $number;
            }
        }
        return $row;
    }
}