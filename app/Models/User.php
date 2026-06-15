<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

<<<<<<< HEAD
#[Fillable(['name', 'email', 'password', 'account_number', 'balance'])]
#[Hidden(['password', 'remember_token'])]
=======
>>>>>>> 457bade21dc10287e872c1a9f3f9208271a90a53
class User extends Authenticatable
{
    use Notifiable;

<<<<<<< HEAD
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'balance' => 'decimal:2',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->account_number)) {
                $user->account_number = static::generateAccountNumber();
            }
        });
    }

    /**
     * Generate a unique 10-digit account number.
     */
    protected static function generateAccountNumber(): string
    {
        do {
            // Generate a random 10-digit number
            $accountNumber = strval(rand(1000000000, 9999999999));
        } while (static::where('account_number', $accountNumber)->exists());

        return $accountNumber;
    }
=======
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'account_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
>>>>>>> 457bade21dc10287e872c1a9f3f9208271a90a53
}
