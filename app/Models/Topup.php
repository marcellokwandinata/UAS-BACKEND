<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topup extends Model
{
    protected $table = 'topups';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'payment_method',
        'nominal',
        'status'
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
