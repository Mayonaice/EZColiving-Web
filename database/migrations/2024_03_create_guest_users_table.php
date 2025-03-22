<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('guest_users', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->unique();
            $table->string('device_info')->nullable();
            $table->string('last_activity')->nullable();
            $table->json('cart_data')->nullable();
            $table->json('booking_history')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guest_users');
    }
}; 