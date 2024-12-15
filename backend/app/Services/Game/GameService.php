<?php

namespace App\Services\Game;

use App\Services\Game\Contracts\GameServiceInterface;
use App\Services\Game\Extractors\NumberExtractor;
use App\Services\Game\Validators\WinValidator;
use App\Repositories\Game\GameRepository;
use App\Repositories\Player\PlayerRepository;

class GameService implements GameServiceInterface
{
    public function __construct(
        private GameRepository $gameRepository,
        private PlayerRepository $playerRepository,
        private NumberExtractor $numberExtractor,
        private WinValidator $winValidator
    ) {}

    public function extractNumber(): int
    {
        $game = $this->gameRepository->getCurrentGame();
        $number = $this->numberExtractor->extract($game->extracted_numbers ?? []);
        
        $this->gameRepository->addExtractedNumber($game, $number);
        
        return $number;
    }

    public function getCurrentGame()
    {
        return $this->gameRepository->getCurrentGame();
    }

    public function checkWin(string $playerId, string $winType): bool
    {
        $this->winValidator->validate($winType);
        
        $player = $this->playerRepository->findWithCards($playerId);
        $game = $this->getCurrentGame();
        
        foreach ($player->cards as $card) {
            $cardNumbers = array_merge(...$card->rows);
            if ($this->winValidator->checkWinCondition($cardNumbers, $game->extracted_numbers, $winType)) {
                return true;
            }
        }
        
        return false;
    }
}