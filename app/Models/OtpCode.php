<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $fillable = ['email', 'otp', 'expires_at', 'used'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used'       => 'boolean',
    ];

    public function isExpired(): bool
    {
        return now()->isAfter($this->expires_at);
    }

    public function isValid(string $otp): bool
    {
        return !$this->used && !$this->isExpired() && $this->otp === $otp;
    }
}
