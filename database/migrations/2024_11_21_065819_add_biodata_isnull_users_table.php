<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiodataIsnullUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nama_lengkap')) {
                $table->string('nama_lengkap',100)->nullable()->change();
            }
            if (Schema::hasColumn('users', 'alias')) {
                $table->string('alias',100)->nullable()->change();
            }
            if (Schema::hasColumn('users', 'nik')) {
                $table->string('nik',20)->nullable()->change();
            }
            if (Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'telp')) {
                $table->string('telp',15)->nullable()->change();
            }
            if (Schema::hasColumn('users', 'npwp')) {
                $table->string('npwp',20)->nullable()->change();
            }
            if (Schema::hasColumn('users', 'norek')) {
                $table->string('norek',50)->nullable()->change();
            }
            if (Schema::hasColumn('users', 'nama_rek')) {
                $table->string('nama_rek',50)->nullable()->change();
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
