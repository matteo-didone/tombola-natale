<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Player;
use App\Models\Card;
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

    public function createCard(): array
    {
        $card = [
            'riga1' => $this->generateRandomRow(),
            'riga2' => $this->generateRandomRow(),
            'riga3' => $this->generateRandomRow()
        ];

        return $card;
    }

    private function generateRandomRow(): array
    {
        $numbers = [];
        while (count($numbers) < 5) {
            $number = rand(1, 90);
            if (!in_array($number, $numbers)) {
                $numbers[] = $number;
            }
        }
        sort($numbers);
        return $numbers;
    }

    public function checkWin(int $playerId, string $winType): bool
    {
        $player = Player::with('cards')->findOrFail($playerId);
        $game = Game::first();

        if (!$game) {
            throw new \Exception('No active game found');
        }

        foreach ($player->cards as $card) {
            $cardNumbers = $this->winChecker->flattenCardNumbers($card->rows);
            if ($this->winChecker->checkWin($cardNumbers, $game->extracted_numbers, $winType)) {
                return true;
            }
        }

        return false;
    }

    public function getExtractedNumbers(): array
    {
        $game = Game::first();
        return $game ? $game->extracted_numbers ?? [] : [];
    }

    public function resetGame(): void
    {
        $game = Game::first();
        if ($game) {
            $game->update([
                'status' => 'active',
                'current_number' => null,
                'extracted_numbers' => []
            ]);
        }
    }

    public function getCurrentGame(): ?Game
    {
        return Game::first();
    }

    private function validateCard(array $card): bool
    {
        // Verifica che la carta abbia 3 righe
        if (!isset($card['riga1']) || !isset($card['riga2']) || !isset($card['riga3'])) {
            return false;
        }

        // Verifica che ogni riga abbia 5 numeri
        foreach (['riga1', 'riga2', 'riga3'] as $riga) {
            if (!is_array($card[$riga]) || count($card[$riga]) !== 5) {
                return false;
            }

            // Verifica che i numeri siano compresi tra 1 e 90
            foreach ($card[$riga] as $numero) {
                if (!is_int($numero) || $numero < 1 || $numero > 90) {
                    return false;
                }
            }
        }

        // Verifica che non ci siano numeri duplicati nella carta
        $allNumbers = array_merge($card['riga1'], $card['riga2'], $card['riga3']);
        return count($allNumbers) === count(array_unique($allNumbers));
    }
}