<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referral_commission_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('percentage', 5, 2)->default(0);
            $table->bigInteger('min_deposit')->default(0);
            $table->bigInteger('max_commission')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_commission_settings');
    }
};
