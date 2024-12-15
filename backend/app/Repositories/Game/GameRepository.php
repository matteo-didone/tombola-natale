<?php

namespace App\Repositories\Game;

use App\Models\Game;
use App\Repositories\Game\Contracts\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{
    public function getCurrentGame(): Game
    {
        return Game::firstOrCreate(
            ['id' => 1],
            [
                'status' => 'active',
                'extracted_numbers' => [],
                'current_number' => null
            ]
        );
    }
    
    public function addExtractedNumber(Game $game, int $number): void
    {
        $extractedNumbers = $game->extracted_numbers ?? [];
        $extractedNumbers[] = $number;
        
        $game->update([
            'current_number' => $number,
            'extracted_numbers' => $extractedNumbers
        ]);
    }
}