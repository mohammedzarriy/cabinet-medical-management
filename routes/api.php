<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\RendezvousApiController;
use Illuminate\Support\Facades\Route;

// ── Public API ──
Route::post('/login', [AuthApiController::class, 'login']);

// ── Protected API ──
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/rendezvous',  [RendezvousApiController::class, 'index']);
    Route::post('/rendezvous', [RendezvousApiController::class, 'store']);
    Route::get('/services',    [RendezvousApiController::class, 'services']);
    Route::post('/logout',     [AuthApiController::class, 'logout']);
});
