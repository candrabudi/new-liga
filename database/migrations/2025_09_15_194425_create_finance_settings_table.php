<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFinanceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_deposit', 15, 2)->default(0.00)->comment('Minimum deposit');
            $table->decimal('max_deposit', 15, 2)->default(0.00)->comment('Maximum deposit (0 = no limit)');
            $table->decimal('min_withdraw', 15, 2)->default(0.00)->comment('Minimum withdraw');
            $table->decimal('max_withdraw', 15, 2)->default(0.00)->comment('Maximum withdraw (0 = no limit)');
            $table->timestamps();
        });

        DB::table('finance_settings')->insert([
            'min_deposit'  => 0.00,
            'max_deposit'  => 0.00,
            'min_withdraw' => 0.00,
            'max_withdraw' => 0.00,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_settings');
    }
}
