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
        Schema::dropIfExists('cart');
        Schema::dropIfExists('invoice_detail');
        Schema::dropIfExists('barang');
        
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('images',255)->nullable();
            $table->string('sku',50);
            $table->string('nmbarang',100);
            $table->integer('stok');
            $table->double('harga');
            $table->integer('berat');
            $table->integer('diskon_percent');
            $table->text('deskripsi');
            $table->boolean('isactive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
