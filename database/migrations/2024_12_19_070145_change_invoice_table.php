<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            if (!Schema::hasColumn('invoice', 'ongkir')) {
                $table->double('ongkir')->nullable();
            }
        });
        Schema::table('invoice_detail', function (Blueprint $table) {
            if (Schema::hasColumn('invoice_detail', 'ongkir')) {
                $table->dropcolumn('ongkir');
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
