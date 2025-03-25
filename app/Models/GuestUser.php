<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    protected $fillable = [
        'device_name',
        'device_info',
        'last_activity',
        'cart_data',
        'booking_history'
    ];

    protected $casts = [
        'device_info' => 'array',
        'cart_data' => 'array',
        'booking_history' => 'array',
        'last_activity' => 'datetime'
    ];
} 