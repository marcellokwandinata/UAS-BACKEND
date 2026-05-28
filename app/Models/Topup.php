<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = 'topups';

    protected $fillable = [
        'payment_method',
        'nominal',
        'status'
    ];
}
