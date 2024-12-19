<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAddInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            if (!Schema::hasColumn('invoice', 'jenis_pengiriman')) {
                $table->double('jenis_pengiriman')->nullable();
            }
            if (Schema::hasColumn('invoice', 'kelurahan')) {
                $table->dropcolumn('kelurahan');
            }
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
