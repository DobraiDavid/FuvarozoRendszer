<?php

use App\Http\Controllers\Api\MunkaApiController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    // Munkak endpoints
    Route::apiResource('munkak', MunkaApiController::class);

    // Update munka status
    Route::patch('munkak/{munka}/status', [MunkaApiController::class, 'updateStatus']);

    // Get munkak for specific fuvarozo
    Route::get('fuvarozok/{fuvarozo}/munkak', [MunkaApiController::class, 'fuvarozoMunkak']);
});