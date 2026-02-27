<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ChatController;

Route::prefix('setup')->group(function () {
    Route::get('/', [SetupController::class, 'show']);
    Route::post('/', [SetupController::class, 'store']);
});

Route::prefix('chat')->group(function () {
    Route::post('/', [ChatController::class, 'send']);
    Route::get('/', [ChatController::class, 'conversations']);
});