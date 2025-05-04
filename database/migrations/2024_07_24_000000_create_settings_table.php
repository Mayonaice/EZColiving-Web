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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Tambahkan pengaturan default untuk WhatsApp
        $this->seedDefaultSettings();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }

    /**
     * Seed default settings
     */
    protected function seedDefaultSettings(): void
    {
        $settings = [
            [
                'key' => 'whatsapp_sender_number',
                'value' => null,
                'description' => 'Nomor WhatsApp yang digunakan untuk mengirim notifikasi (format: 628xxxxxxxxxx)',
            ],
            [
                'key' => 'whatsapp_enabled',
                'value' => 'false',
                'description' => 'Aktifkan notifikasi WhatsApp',
            ],
        ];

        $settingsTable = app('db')->table('settings');
        foreach ($settings as $setting) {
            $settingsTable->insert($setting);
        }
    }
}; 