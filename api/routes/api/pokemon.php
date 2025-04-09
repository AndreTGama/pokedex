<?php

use App\Http\Controllers\Pokemon\PokemonController;
use Illuminate\Support\Facades\Route;

Route::prefix('pokemon')->group(function () {
    Route::get('/{limit}/{page}', [PokemonController::class, 'list'])->name('pokemon.list');
});
