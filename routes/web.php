<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Redirect ke login saat buka domain utama
Route::get('/', function () {
    return redirect()->route('login');
});

// AUTH NASABAH (Login & Register)
Route::get('/login',     [AuthController::class, 'index'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.perform');
Route::get('/register',  [AuthController::class, 'create'])->name('user.create');
Route::post('/register', [AuthController::class, 'store'])->name('user.store');

// USER NASABAH 
Route::middleware(['auth'])->group(function () {
    Route::get('/user',                            [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}',                       [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit',                  [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}',                     [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',                    [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/{id}/change-password',       [UserController::class, 'changePasswordForm'])->name('user.changePasswordForm');
    Route::patch('/user/{id}/change-password',     [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/logout',                         [AuthController::class, 'logout'])->name('logout');
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