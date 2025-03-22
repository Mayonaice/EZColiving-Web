<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    protected $fillable = [
        'ip_address',
        'device_info',
        'last_activity',
        'cart_data',
        'booking_history'
    ];

    protected $casts = [
        'cart_data' => 'array',
        'booking_history' => 'array'
    ];
} 