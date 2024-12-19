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
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang');
            $table->string('sku',50);
            $table->string('nmbarang',100);
            $table->integer('stok');
            $table->double('harga');
            $table->integer('berat');
            $table->integer('diskon_percent');
            $table->text('deskripsi');
            $table->integer('jumlah');
            $table->double('ongkir');
            $table->double('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_detail');
    }
};
