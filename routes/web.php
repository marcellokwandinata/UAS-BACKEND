<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return redirect('/accounts');
});

Route::resource('posts', PostController::class);

Route::resource('accounts', AccountController::class);