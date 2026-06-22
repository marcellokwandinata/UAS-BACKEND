<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TokenModel extends Model
{
    protected $table = 'tokens';

    protected $fillable = [
        'user_id',
        'token',
        'type',
        'expires_at',
        'last_used_at',
        'revoked',
    ];

    protected $casts = [
        'expires_at'   => 'datetime',
        'last_used_at' => 'datetime',
        'revoked'      => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function saveToken(int $userId, string $type = 'api', int $minutes = 60): static
    {
        // Hapus token lama milik user dengan tipe yang sama sebelum buat baru
        static::where('user_id', $userId)
              ->where('type', $type)
              ->delete();

        return static::create([
            'user_id'    => $userId,
            'token'      => hash('sha256', Str::random(60)),
            'type'       => $type,
            'expires_at' => Carbon::now()->addMinutes($minutes),
            'revoked'    => false,
        ]);
    }
   
  static function getToken(string $token): ?static
    {
        return static::where('token', $token)
                     ->where('revoked', false)
                     ->where('expires_at', '>', Carbon::now())
                     ->first();
    }

    public static function getActiveTokensByUser(int $userId, string $type = ''): \Illuminate\Database\Eloquent\Collection
    {
        $query = static::where('user_id', $userId)
                       ->where('revoked', false)
                       ->where('expires_at', '>', Carbon::now());

        if (!empty($type)) {
            $query->where('type', $type);
        }

        return $query->get();
    }


    public static function deleteToken(string $token): bool
    {
        return (bool) static::where('token', $token)
                            ->update(['revoked' => true]);
    }

    public static function revokeAllByUser(int $userId, string $type = ''): int
    {
        $query = static::where('user_id', $userId);

        if (!empty($type)) {
            $query->where('type', $type);
        }

        return $query->update(['revoked' => true]);
    }


    public static function cleanupOld(): int
    {
        return static::where(function ($query) {
            $query->where('expires_at', '<', Carbon::now())
                  ->orWhere('revoked', true);
        })->delete();
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }


    public function isValid(): bool
    {
        return !$this->revoked && !$this->isExpired();
    }

    public function markAsUsed(): bool
    {
        return $this->update(['last_used_at' => Carbon::now()]);
    }
}