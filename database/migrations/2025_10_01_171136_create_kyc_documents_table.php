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
        Schema::create('kyc_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('profile_id')
                  ->nullable()
                  ->constrained('profiles')
                  ->onDelete('cascade');

            $table->string('referral_code', 50)->nullable();

            $table->enum('document_type', ['KTP', 'SIM', 'PASSPORT'])->default('KTP');
            $table->string('document_number', 100)->nullable();
            $table->string('file_path'); // lokasi file upload
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_documents');
    }
};
