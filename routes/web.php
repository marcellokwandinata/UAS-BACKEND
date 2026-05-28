<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TopupController;

Route::get('/', function () {
    return view('welcome');
});

// histories
Route::get('/histories', [HistoryController::class, 'index']);
Route::get('/histories/{id}', [HistoryController::class, 'show']);
Route::post('/histories', [HistoryController::class, 'store']);
Route::delete('/histories/{id}', [HistoryController::class, 'destroy']);

// topups
Route::get('/topups', [TopupController::class, 'index']);
Route::get('/topups/{id}', [TopupController::class, 'show']);
Route::post('/topups', [TopupController::class, 'store']);