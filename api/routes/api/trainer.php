<?php

use App\Http\Controllers\Trainer\TrainerController;
use Illuminate\Support\Facades\Route;

Route::prefix('trainer')->group(function () {
    // Route::get('/', [TrainerController::class, 'index']);
    // Route::get('/{id}/edit', [TrainerController::class, 'edit']);
    Route::post('/', [TrainerController::class, 'store']);
    // Route::put('/{id}', [TrainerController::class, 'update']);
});
