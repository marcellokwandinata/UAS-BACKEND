<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class History extends Model
{
    protected $table = 'histories';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'transaction_code',
        'title',
        'description',
        'amount',
        'balance_after',
        'transaction_time'
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}




