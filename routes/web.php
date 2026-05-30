<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\SecurityController;

Route::get('/', function () {
    return view('welcome');
});

// cards
Route::get('/cards/create', function () {
    return view('create_cards');
});

Route::get('/cards', [CardsController::class, 'index'])->name('cards_index');
Route::get('/cards/create', [CardsController::class, 'create'])->name('create_cards');
Route::post('/cards', [CardsController::class, 'store']);

// securities
Route::get('/securities', [SecurityController::class, 'index']);
Route::get('/securities/{id}', [SecurityController::class, 'show']);
Route::post('/securities', [SecurityController::class, 'store']);