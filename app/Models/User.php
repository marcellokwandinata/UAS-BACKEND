<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Jika kamu menggunakan autentikasi bawaan Laravel, pastikan use Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['full_name', 'email', 'password', 'account_number'];
}