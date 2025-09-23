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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['deposit', 'withdraw', 'bonus', 'promotion', 'adjustment']);
            $table->enum('trx_type', ['credit', 'debit']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->foreignId('payment_channel_id')->nullable()->constrained('payment_channels')->nullOnDelete();

            $table->string('proof')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->bigInteger('amount')->default(0);
            $table->text('reason')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
