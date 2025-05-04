<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'guest_user_id',
        'payment_id',
        'name_booking',
        'phone_booking',
        'email_booking',
        'booking_number',
        'rental_type',
        'rental_duration',
        'total_price',
        'booking_date',
        'booking_date_in',
        'booking_date_out',
        'booking_status'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'booking_date_in' => 'date',
        'booking_date_out' => 'date',
        'total_price' => 'decimal:2'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function guestUser()
    {
        return $this->belongsTo(GuestUser::class);
    }
} 