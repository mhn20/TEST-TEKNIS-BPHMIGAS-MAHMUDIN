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
        Schema::dropIfExists('invoice_detail');
        Schema::dropIfExists('invoice');
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('negara',30)->nullable();
            $table->string('kota',30)->nullable();
            $table->string('kecamatan',30)->nullable();
            $table->string('kelurahan',30)->nullable();
            $table->text('alamat')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->text('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
