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
        Schema::create('room_damages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('damage_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('guest_user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('description');
            $table->decimal('damage_cost', 10, 2);
            $table->enum('payment_status', ['Unpaid', 'Pending', 'Paid'])->default('Unpaid');
            $table->string('payment_proof')->nullable();
            $table->date('payment_date')->nullable();
            $table->date('payment_confirmed_date')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_damages');
    }
}; 