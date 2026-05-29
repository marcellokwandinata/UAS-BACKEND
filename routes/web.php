<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// 1. ENDPOINT AUTH (Halaman Pertama / Awal)
Route::get('/auth', [AuthController::class, 'index'])->name('login');         // Tampilan Form Login
Route::post('/auth', [AuthController::class, 'login'])->name('login.perform'); // Eksekusi Login
Route::get('/auth/create', [AuthController::class, 'create'])->name('User.create'); // Tampilan Form Register
Route::post('/auth/store', [AuthController::class, 'store'])->name('User.store');   // Eksekusi Pendaftaran

// Redirection default supaya kalau buka http://127.0.0.1:8000 langsung ke login
Route::get('/', function () { return redirect()->route('login'); });


// 2. ENDPOINT USER (Halaman Utama / Dashboard)
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index'); // Halaman Utama Akun Pengguna
    Route::delete('/auth/{id}', [AuthController::class, 'logout'])->name('logout'); // Jalur Logout
});