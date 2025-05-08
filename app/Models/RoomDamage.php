<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDamage extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'damage_category_id',
        'guest_user_id',
        'description',
        'damage_cost',
        'payment_status',
        'payment_proof',
        'payment_date',
        'payment_confirmed_date',
        'confirmed_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'payment_confirmed_date' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function damageCategory()
    {
        return $this->belongsTo(DamageCategory::class);
    }

    public function guestUser()
    {
        return $this->belongsTo(GuestUser::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
} 