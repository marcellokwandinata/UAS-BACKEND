<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TopupController;

Route::get('/', function () {
    return view('welcome');
});

// topups
Route::get('/topups/create', function () {
    return view('create_topup');
});
Route::get('/topups', [TopupController::class, 'index']);
Route::get('/topups/{id}', [TopupController::class, 'show']);

// histories
Route::get('/histories', [HistoryController::class, 'index']);
Route::get('/histories/{id}', [HistoryController::class, 'show']);

