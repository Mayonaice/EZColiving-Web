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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_payment_id')->constrained('master_payments')->onDelete('cascade');
            $table->string('payment_name');
            $table->string('payment_number');
            $table->string('payment_amount');
            $table->text('payment_image')->nullable();
            $table->enum('payment_status', ['Pending', 'Confirmed', 'Failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
