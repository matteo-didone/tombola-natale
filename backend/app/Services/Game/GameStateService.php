<?php

namespace App\Services\Game;

use App\Models\Game;
use App\Services\Game\NumberGeneratorService;

class GameStateService
{
    private $numberGenerator;
    
    public function __construct(NumberGeneratorService $numberGenerator)
    {
        $this->numberGenerator = $numberGenerator;
    }
    
    public function getCurrentGame(): Game
    {
        return Game::firstOrCreate(
            ['id' => 1],
            ['status' => 'active', 'extracted_numbers' => []]
        );
    }
    
    public function extractNumber(): int
    {
        $game = $this->getCurrentGame();
        $number = $this->numberGenerator->generate($game->extracted_numbers ?? []);
        
        $extractedNumbers = $game->extracted_numbers ?? [];
        $extractedNumbers[] = $number;
        
        $game->update([
            'current_number' => $number,
            'extracted_numbers' => $extractedNumbers
        ]);
        
        return $number;
    }
}