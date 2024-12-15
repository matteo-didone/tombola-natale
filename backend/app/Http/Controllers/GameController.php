<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\GameService;
use App\Http\Requests\CheckWinRequest;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    private $gameService;
    
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }
    
    public function extract(): JsonResponse
    {
        try {
            $number = $this->gameService->extractNumber();
            return response()->json(['number' => $number]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    public function checkWin(CheckWinRequest $request): JsonResponse
    {
        try {
            $isWinner = $this->gameService->checkWin(
                $request->playerId,
                $request->winType
            );
            
            return response()->json(['isWinner' => $isWinner]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}