<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\Cache;

class GameService
{
    private $winChecker;
    
    public function __construct(WinCheckerService $winChecker)
    {
        $this->winChecker = $winChecker;
    }

    public function extractNumber(): int
    {
        $game = Game::firstOrCreate(
            ['id' => 1],
            ['status' => 'active', 'extracted_numbers' => []]
        );
        
        $availableNumbers = array_diff(
            range(1, 90),
            $game->extracted_numbers ?? []
        );
        
        if (empty($availableNumbers)) {
            throw new \Exception('All numbers have been extracted');
        }
        
        $number = $availableNumbers[array_rand($availableNumbers)];
        $extractedNumbers = $game->extracted_numbers ?? [];
        $extractedNumbers[] = $number;
        
        $game->update([
            'current_number' => $number,
            'extracted_numbers' => $extractedNumbers
        ]);
        
        return $number;
    }
    
    public function checkWin(int $playerId, string $winType): bool
    {
        $player = Player::with('cards')->findOrFail($playerId);
        $game = Game::first();
        
        foreach ($player->cards as $card) {
            $cardNumbers = $this->winChecker->flattenCardNumbers($card->rows);
            if ($this->winChecker->checkWin($cardNumbers, $game->extracted_numbers, $winType)) {
                return true;
            }
        }
        
        return false;
    }
}