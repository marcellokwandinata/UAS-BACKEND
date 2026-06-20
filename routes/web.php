<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


// Redirect ke login saat buka domain utama
Route::get('/', function () {
    return redirect()->route('login');
});

// AUTH (Login & Register)
Route::get('/login',    [AuthController::class, 'index'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.perform');
Route::get('/register', [AuthController::class, 'create'])->name('user.create');
Route::post('/register',[AuthController::class, 'store'])->name('user.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/user',             [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}',        [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit',   [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}',      [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',     [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/logout',          [AuthController::class, 'logout'])->name('logout');
});

// cards
Route::get('/cards/create', function () {
    return view('create_cards');
});

Route::get('/cards', [CardsController::class, 'index'])->name('cards_index');
Route::get('/cards/create', [CardsController::class, 'create'])->name('create_cards');
Route::post('/cards', [CardsController::class, 'store']);
Route::get('/cards/{id}', [CardsController::class, 'show'])->name('show_cards');
Route::get('/cards/{id}/edit',  [CardsController::class, 'edit'])->name('cards.edit');
Route::patch('/cards/{id}',     [CardsController::class, 'update'])->name('cards.update');
Route::delete('/cards/{id}',    [CardsController::class, 'destroy'])->name('cards.destroy');

// securities
Route::get('/securities', [SecurityController::class, 'index'])->name('security.index');
Route::post('/securities', [SecurityController::class, 'store'])->name('security.store');
Route::get('/securities/create', [SecurityController::class, 'create'])->name('security.create');
Route::get('/securities/pin', [SecurityController::class, 'pinEdit'])->name('security.pin');
Route::patch('/securities/pin', [SecurityController::class, 'pinUpdate'])->name('security.pin.update');
Route::get('/securities/{id}', [SecurityController::class, 'show'])->name('security.show');
Route::get('/securities/{id}/edit', [SecurityController::class, 'edit'])->name('security.edit');
Route::patch('/securities/{id}', [SecurityController::class, 'update'])->name('security.update');
Route::delete('/securities/{id}', [SecurityController::class, 'destroy'])->name('security.destroy');

