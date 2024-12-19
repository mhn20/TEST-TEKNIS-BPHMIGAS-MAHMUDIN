<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAlamatUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_kontrak')->nullable();
            $table->string('hari')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('tempat')->nullable();
            $table->string('bulan',5)->nullable();
            $table->string('tahun',10)->nullable();
            $table->string('namabank')->nullable();
            $table->string('cabang')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('tujuan')->nullable();
            $table->text('alamat')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
