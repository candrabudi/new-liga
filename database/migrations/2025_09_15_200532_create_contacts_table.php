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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('platform')->comment('telegram / whatsapp / line / dll');
            $table->string('name')->nullable()->comment('username atau nomor hp');
            $table->string('link')->nullable()->comment('url lengkap menuju kontak');
            $table->string('icon')->nullable()->comment('path atau url icon jika diperlukan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
