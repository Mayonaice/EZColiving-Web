<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'device_name',
        'device_info',
        'last_activity',
        'cart_data',
        'booking_history'
    ];

    protected $casts = [
        'device_info' => 'array',
        'last_activity' => 'datetime',
        'cart_data' => 'array',
        'booking_history' => 'array'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 