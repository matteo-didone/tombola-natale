<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Player\JoinGameRequest;
use App\Services\Player\PlayerService;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    public function __construct(
        private PlayerService $playerService
    ) {}
    
    public function join(JoinGameRequest $request): JsonResponse
    {
        try {
            $player = $this->playerService->createPlayer($request->validated('name'));
            return response()->json(['player' => $player]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}