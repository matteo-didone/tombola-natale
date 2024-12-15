<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\CardService;
use App\Http\Requests\JoinGameRequest;
use App\Http\Requests\CreateCardRequest;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\CardResource;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    private $cardService;
    
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }
    
    public function join(JoinGameRequest $request): JsonResponse
    {
        try {
            $player = Player::create($request->validated());
            return response()->json([
                'player' => new PlayerResource($player->load('cards'))
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    public function createCard(CreateCardRequest $request): JsonResponse
    {
        try {
            $card = $this->cardService->createCard($request->playerId);
            return response()->json([
                'card' => new CardResource($card)
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}