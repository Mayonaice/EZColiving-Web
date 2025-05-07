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
        Schema::create('master_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_name');
            $table->string('payment_type');
            $table->string('payment_account_number');
            $table->string('payment_qrcode');
            $table->enum('payment_status', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_payments');
    }
};
