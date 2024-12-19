<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendapatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pendapatan');
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->id();
            $table->string('pragita_composer_id',30);
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('tahunbulan');
            $table->double('total_gross_royalti');
            $table->integer('management_fee_percent')->nullable()->default(0);
            $table->double('management_fee')->nullable()->default(0);
            $table->integer('gross_royalti')->nullable()->default(0);
            $table->integer('pph23_percent')->nullable()->default(0);
            $table->double('pph23')->nullable()->default(0);
            $table->boolean('isnpwp')->nullable()->default(false);
            $table->integer('npwp_percent')->nullable()->default(0);
            $table->double('npwp')->nullable()->default(0);
            $table->boolean('isnppn')->nullable()->default(false);
            $table->integer('nppn_percent')->nullable()->default(0);
            $table->double('nppn')->nullable()->default(0);
            $table->double('total_net_royalti')->nullable()->default(0);
            $table->boolean('error')->default(false);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pendapatan');
    }
}
