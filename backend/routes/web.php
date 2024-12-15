<?php 
Route::get('/check-env', function () {
    return [
        'SESSION_DRIVER' => env('SESSION_DRIVER'),
        'APP_ENV' => env('APP_ENV'),
    ];
});
