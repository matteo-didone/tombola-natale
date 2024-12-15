<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Player;

class CardService
{
    public function createCard(int $playerId): Card
    {
        $player = Player::findOrFail($playerId);
        $rows = $this->generateRows();
        
        return $player->cards()->create([
            'rows' => $rows
        ]);
    }
    
    private function generateRows(): array
    {
        $rows = [];
        $usedNumbers = [];
        
        for ($i = 0; $i < 3; $i++) {
            $row = [];
            while (count($row) < 5) {
                $number = rand(1, 90);
                if (!in_array($number, $usedNumbers)) {
                    $row[] = $number;
                    $usedNumbers[] = $number;
                }
            }
            sort($row);
            $rows[] = $row;
        }
        
        return $rows;
    }
}