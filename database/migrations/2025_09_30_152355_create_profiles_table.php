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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->unique();
            $table->string('full_name', 150);
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->text('address')->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('state', 100)->nullable();

            // Informasi Kontak
            $table->string('contact_no', 16)->nullable();
            $table->string('email', 100)->unique();
            $table->string('telegram', 16)->nullable();
            $table->string('whatsapp', 16)->nullable();
            $table->string('wechat', 50)->nullable();
            $table->string('line', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
