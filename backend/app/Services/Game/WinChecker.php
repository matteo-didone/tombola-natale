<?php

namespace App\Services\Game;

use App\Models\Player;
use App\Models\Game;
use App\Repositories\Game\GameRepository;
use App\Repositories\Player\PlayerRepository;
use App\Exceptions\GameException;

class WinChecker
{
    private const WIN_CONDITIONS = [
        'ambo' => 2,
        'terno' => 3,
        'quaterna' => 4,
        'cinquina' => 5,
        'tombola' => 15
    ];

    public function __construct(
        private GameRepository $gameRepository,
        private PlayerRepository $playerRepository
    ) {}

    public function check(string $playerId, string $winType): bool
    {
        if (!isset(self::WIN_CONDITIONS[$winType])) {
            throw GameException::invalidWinType($winType);
        }

        $player = $this->playerRepository->findWithCards($playerId);
        $game = $this->gameRepository->getCurrentGame();
        $requiredMatches = self::WIN_CONDITIONS[$winType];

        foreach ($player->cards as $card) {
            $matches = $this->countMatches($card->rows, $game->extracted_numbers);
            if ($matches >= $requiredMatches) {
                return true;
            }
        }

        return false;
    }

    private function countMatches(array $cardRows, array $extractedNumbers): int
    {
        $cardNumbers = array_merge(...$cardRows);
        return count(array_intersect($cardNumbers, $extractedNumbers));
    }
}