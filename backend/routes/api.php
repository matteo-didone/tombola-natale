<?php

use App\Http\Controllers\Api\V1\GameController;
use App\Http\Controllers\Api\V1\PlayerController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['cors'])->group(function () {
    Route::post('/extract', [GameController::class, 'extract']);
    Route::post('/players', [PlayerController::class, 'join']);
});