<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsPendapatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('settings_pendapatan');
        Schema::create('settings_pendapatan', function (Blueprint $table) {
            $table->id();
            $table->integer('management_fee_percent')->nullable()->default(0);
            $table->integer('pph23_percent')->nullable()->default(0);
            $table->integer('npwp_percent')->nullable()->default(0);
            $table->integer('nppn_percent')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings_pendapatan');
    }
}
