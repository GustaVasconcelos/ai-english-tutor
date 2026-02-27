<?php

use Illuminate\Support\Facades\Route;
use App\Ai\Agents\EnglishTutor;

Route::get('/ping', function () {
    return response()->json([
        'pong' => 'ok'
    ]);
});

Route::get('/ai-test', function () {
    $response = EnglishTutor::make()->prompt('Explique o verbo "to be"');

    return (string)$response;
});