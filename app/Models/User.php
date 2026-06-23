<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name', // Kita masukkan dua-duanya agar aman dari perubahan tim
        'email',
        'password',
        'account_number',
        'balance',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function savings()
    {
    return $this->hasMany(Saving::class);
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
}
