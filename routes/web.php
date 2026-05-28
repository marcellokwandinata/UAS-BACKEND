<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Halaman awal otomatis diarahkan ke Dashboard User
Route::get('/', function () {
    return redirect('/User');
});

// Fitur Autentikasi Publik
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.perform');
Route::get('/register', [UserController::class, 'create'])->name('User.create');
Route::post('/register', [UserController::class, 'store'])->name('User.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard Utama (Harus Login)
Route::get('/User', [UserController::class, 'index'])->name('User.index');