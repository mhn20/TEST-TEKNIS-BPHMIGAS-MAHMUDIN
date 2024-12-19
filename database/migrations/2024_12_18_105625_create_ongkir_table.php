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
        Schema::dropIfExists('ongkir');
        Schema::create('ongkir', function (Blueprint $table) {
            $table->id();
            $table->string('subdistrict_id',50); 
            $table->string('province_id',50);
            $table->string('province',50); 
            $table->string('city_id',50); 
            $table->string('city',50); 
            $table->string('type',50); 
            $table->string('subdistrict_name',50); 
            $table->string('service',50); 
            $table->string('description',50); 
            $table->string('etd',50); 
            $table->double('ongkir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongkir');
    }
};
