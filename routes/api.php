<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;

Route::prefix('setup')->group(function () {
    Route::get('/', [SetupController::class, 'show']);
    Route::post('/', [SetupController::class, 'store']);
});