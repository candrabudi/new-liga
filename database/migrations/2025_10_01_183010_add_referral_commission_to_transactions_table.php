<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM('deposit', 'withdraw', 'bonus', 'promotion', 'adjustment', 'commission') NOT NULL");
            $table->foreignId('referrer_id')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('referred_user_id')
                ->nullable()
                ->after('referrer_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->decimal('referral_percentage', 5, 2)
                ->nullable()
                ->after('referred_user_id');

            $table->bigInteger('referral_commission')
                ->default(0)
                ->after('referral_percentage');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['referrer_id']);
            $table->dropColumn('referrer_id');

            $table->dropForeign(['referred_user_id']);
            $table->dropColumn('referred_user_id');

            $table->dropColumn('referral_percentage');
            $table->dropColumn('referral_commission');

            DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM('deposit', 'withdraw', 'bonus', 'promotion', 'adjustment') NOT NULL");
        });
    }
};
