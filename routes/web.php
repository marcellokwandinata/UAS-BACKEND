<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\SecurityController;

Route::get('/', function () {
    return view('welcome');
});

// cards
Route::get('/cards/create', function () {
    return view('create_card');
});

Route::get('/cards', [CardsController::class, 'index']);
Route::get('/cards/{id}', [CardsController::class, 'show']);
Route::post('/cards', [CardsController::class, 'store']);

// securities
Route::get('/securities', [SecurityController::class, 'index']);
Route::get('/securities/{id}', [SecurityController::class, 'show']);
Route::post('/securities', [SecurityController::class, 'store']);