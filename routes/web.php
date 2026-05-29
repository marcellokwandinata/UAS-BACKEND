<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TopupController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-balance', function () {
    session()->forget('balance'); // hapus session lama
    session(['balance' => 5000000]); // set ulang

    return "Balance reset ke 5.000.000";
});

// topups
Route::get('/topups/create', function () {
    return view('create_topup');
});
Route::get('/topups', [TopupController::class, 'index']);
Route::get('/topups/{id}', [TopupController::class, 'show']);
Route::post('/topups', [TopupController::class, 'store']);

// histories
Route::get('/histories', [HistoryController::class, 'index']);
Route::get('/histories/{id}', [HistoryController::class, 'show']);

