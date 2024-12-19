<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUploadDokKtpNpwpUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'dokumen_ktp')) {
                $table->text('dokumen_ktp')->nullable()->after('nik');
            }else{
                $table->text('dokumen_ktp')->nullable()->after('nik')->change();
            }
            if (!Schema::hasColumn('users', 'dokumen_npwp')) {
                $table->text('dokumen_npwp')->nullable()->after('npwp');
            }else{
                $table->text('dokumen_npwp')->nullable()->after('npwp')->change();
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
