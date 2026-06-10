<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BeneficiaryController;

// Redirect ke halaman accounts saat buka domain utama
Route::get('/', function () {
    return redirect('/accounts');
});

Route::resource('posts', PostController::class);

Route::resource('accounts', AccountController::class);

Route::resource('beneficiaries', BeneficiaryController::class);