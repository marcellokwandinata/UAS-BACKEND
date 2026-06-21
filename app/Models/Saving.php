<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Saving extends Model
{
       protected $fillable = [
        'user_id',
        'saving_name',
        'target_amount',
        'current_amount',
        'target_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
