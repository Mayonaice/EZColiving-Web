<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_payment_id',
        'payment_name',
        'payment_number',
        'payment_amount',
        'payment_image',
        'payment_status'
    ];

    protected $casts = [
        'payment_amount' => 'string'
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    public function masterPayment()
    {
        return $this->belongsTo(MasterPayment::class);
    }
} 