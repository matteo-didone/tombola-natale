<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\ExtractNumberRequest;
use App\Services\Game\Contracts\GameServiceInterface;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function __construct(
        private GameServiceInterface $gameService
    ) {}
    
    public function extract(ExtractNumberRequest $request): JsonResponse
    {
        try {
            $number = $this->gameService->extractNumber();
            return response()->json(['number' => $number]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}