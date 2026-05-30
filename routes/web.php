<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\CardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-balance', function () {
    session()->forget('balance'); // hapus session lama
    session(['balance' => 5000000]); // set ulang

    return "Balance reset ke 5.000.000";
});

// cards
Route::get('/cards/create', function () {
    return view('create_card');
});

Route::get('/cards', [CardsController::class, 'index']);
Route::get('/cards/{id}', [CardsController::class, 'show']);
Route::post('/cards', [CardsController::class, 'store']);

// securities
Route::get('/security/create', function () {
    return view('create_security');
});

Route::get('/security', [SecurityController::class, 'index']);
Route::get('/security/{id}', [SecurityController::class, 'show']);
Route::post('/security', [SecurityController::class, 'store']);