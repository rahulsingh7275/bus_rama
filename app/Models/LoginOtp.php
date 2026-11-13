<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginOtp extends Model
{
    protected $fillable = [
        'user_id',
        'otp_hash',
        'expires_at',
        'is_verified'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean'
    ];
}