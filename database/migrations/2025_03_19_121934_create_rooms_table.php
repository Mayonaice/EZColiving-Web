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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->string('room_number');
            $table->string('room_type');
            $table->string('room_price');
            $table->text('room_description');
            $table->enum('room_status', ['Available', 'Booked', 'Maintenance'])->default('Available');
            $table->string('deposit_price')->nullable();
            $table->string('name_booking')->nullable();
            $table->string('phone_booking')->nullable();
            $table->date('date_booking')->nullable();
            $table->date('date_booking_out')->nullable();
            $table->date('date_booking_in')->nullable();
            $table->enum('is_check_in', ['Y', 'N'])->default('N');
            $table->enum('is_check_out', ['Y', 'N'])->default('N');
            $table->enum('is_deposit_in', ['Y', 'N'])->default('N');
            $table->enum('is_deposit_out', ['Y', 'N'])->default('Y');
            $table->text('room_image1')->nullable();
            $table->text('room_image2')->nullable();
            $table->text('room_image3')->nullable();
            $table->text('room_image4')->nullable();
            $table->text('room_image5')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
