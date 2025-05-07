<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPayment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_name',
        'payment_type',
        'payment_account_number',
        'payment_qrcode',
        'payment_status',
    ];

    /**
     * Define relationship with other models if needed.
     */
} 