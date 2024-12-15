<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;

Route::prefix('v1')->group(function () {
    Route::post('/extract', [GameController::class, 'extract']);
    Route::post('/cards', [GameController::class, 'createCard']);
    Route::post('/check-win', [GameController::class, 'checkWin']);
    Route::post('/players', [PlayerController::class, 'store']);

    Route::options('{any}', function () {
        return response()->json(null, 200);
    })->where('any', '.*');
});
