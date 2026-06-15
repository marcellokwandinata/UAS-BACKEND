<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
=======
use App\Http\Controllers\TransactionController;
>>>>>>> Stashed changes

// Redirect ke login saat buka domain utama
Route::get('/', function () {
    return redirect()->route('login');
});

// AUTH (Login & Register)
Route::get('/login',    [AuthController::class, 'index'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.perform');
Route::get('/register', [AuthController::class, 'create'])->name('user.create');
Route::post('/register',[AuthController::class, 'store'])->name('user.store');

// USER (wajib login)
Route::middleware(['auth'])->group(function () {
    Route::get('/user',             [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}',        [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit',   [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}',      [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',     [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/logout',          [AuthController::class, 'logout'])->name('logout');
});

Route::get('/transaction', [TransactionController::class,'index'])->name('transaction.index');
Route::get('/transfer', [TransactionController::class, 'transferForm'])->name('transfer.form');
Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transfer.submit');