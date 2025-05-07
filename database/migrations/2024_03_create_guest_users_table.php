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
            $table->string('device_name')->unique();
            $table->json('device_info');
            $table->timestamp('last_activity');
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