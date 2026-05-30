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

Route::get('/cards', [CardController::class, 'index']);
Route::get('/cards/{id}', [CardController::class, 'show']);
Route::post('/cards', [CardController::class, 'store']);

// securities
Route::get('/securities/create', function () {
    return view('create_security');
});

Route::get('/securities', [SecurityController::class, 'index']);
Route::get('/securities/{id}', [SecurityController::class, 'show']);
Route::post('/securities', [SecurityController::class, 'store']);