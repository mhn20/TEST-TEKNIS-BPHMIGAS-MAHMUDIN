<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDokumenPph23Pendapatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendapatan', function (Blueprint $table) {
            if (!Schema::hasColumn('pendapatan', 'dokumen_pph23')) {
                $table->text('dokumen_pph23')->nullable()->after('pph23');
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
