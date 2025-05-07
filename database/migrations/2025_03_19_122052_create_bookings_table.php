<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('guest_user_id')->constrained('guest_users')->onDelete('cascade');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
            $table->string('name_booking');
            $table->string('phone_booking');
            $table->string('email_booking')->nullable();
            $table->string('booking_number');
            $table->string('total_price');
            $table->datetime('booking_date');
            $table->datetime('booking_date_out');
            $table->datetime('booking_date_in');
            $table->enum('booking_status', ['Pending', 'Confirmed', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
