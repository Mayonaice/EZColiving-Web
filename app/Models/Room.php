<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_name',
        'room_number',
        'room_type',
        'room_price',
        'daily_price',
        'room_description',
        'room_status',
        'deposit_price',
        'name_booking',
        'phone_booking',
        'date_booking',
        'date_booking_out',
        'date_booking_in',
        'is_check_in',
        'is_check_out',
        'is_deposit_in',
        'is_deposit_out',
        'room_image1',
        'room_image2',
        'room_image3',
        'room_image4',
        'room_image5'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_booking' => 'date',
        'date_booking_out' => 'date',
        'date_booking_in' => 'date',
    ];

    /**
     * Define relationship with Booking model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Define relationship with RoomDamage model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function damages()
    {
        return $this->hasMany(RoomDamage::class);
    }
} 