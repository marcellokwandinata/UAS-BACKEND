<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;

// Redirect ke halaman accounts saat buka domain utama
Route::get('/', function () {
    return redirect('/user');
});

Route::resource('posts', PostController::class);

Route::resource('beneficiaries', BeneficiaryController::class);
// AUTH NASABAH (Login & Register)
Route::get('/user/login',     [AuthController::class, 'index'])->name('login');
Route::post('/user/login',    [AuthController::class, 'login'])->name('login.perform');
Route::get('/user/register',  [AuthController::class, 'create'])->name('user.create');
Route::post('/user/register', [AuthController::class, 'store'])->name('user.store');

// USER NASABAH 
Route::middleware(['auth'])->group(function () {
    Route::get('/user',             [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}',        [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit',   [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}',      [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',     [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/add-balance',[UserController::class, 'addBalance'])->name('user.addBalance');
    Route::post('/user/reset-balance',[UserController::class, 'resetBalance'])->name('user.resetBalance');
    Route::post('/logout',          [AuthController::class, 'logout'])->name('logout');
    
    // TRANSACTION
    Route::get('/transaction',      [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transfer',         [TransactionController::class, 'transferForm'])->name('transfer.form');
    Route::post('/transfer',        [TransactionController::class, 'transfer'])->name('transfer.submit');
    Route::get('/user',                            [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}',                       [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit',                  [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}',                     [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',                    [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/{id}/change-password',       [UserController::class, 'changePasswordForm'])->name('user.changePasswordForm');
    Route::patch('/user/{id}/change-password',     [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/user/logout',                    [AuthController::class, 'logout'])->name('user.logout');
});

// ADMIN 
Route::get('/admin/login',     [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin/login',    [AdminController::class, 'login'])->name('admin.login.perform');
Route::get('/admin/register',  [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'storeAdmin'])->name('admin.register.store');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard',    [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/user/{id}',    [AdminController::class, 'show'])->name('admin.user.show');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
    Route::post('/admin/logout',      [AdminController::class, 'logout'])->name('admin.logout');
});
