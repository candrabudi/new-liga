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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('ext_code');
            $table->string('referrer_code', 50)->nullable();

            $table->unsignedBigInteger('payment_channel_id')->nullable();
            $table->string('account_name', 24)->nullable();
            $table->string('account_number', 100)->nullable();
            $table->bigInteger('balance')->default(0);

            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
