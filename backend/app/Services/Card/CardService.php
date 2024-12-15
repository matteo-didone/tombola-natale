<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Repositories\Card\CardRepository;
use App\Services\Card\CardGenerator;

class CardService
{
    public function __construct(
        private CardRepository $cardRepository,
        private CardGenerator $cardGenerator
    ) {}

    public function createCard(string $playerId): Card
    {
        $rows = $this->cardGenerator->generateRows();
        return $this->cardRepository->create([
            'player_id' => $playerId,
            'rows' => $rows
        ]);
    }
}