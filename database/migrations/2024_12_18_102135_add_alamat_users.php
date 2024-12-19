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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'keyverif')) {
                $table->string('keyverif',255)->nullable();
            }
            if (!Schema::hasColumn('users', 'keyforgotpassword')) {
                $table->string('keyforgotpassword',255)->nullable();
            }
            if (!Schema::hasColumn('users', 'negara')) {
                $table->string('negara',30)->nullable();
            }
            if (!Schema::hasColumn('users', 'kota')) {
                $table->string('kota',30)->nullable();
            }
            if (!Schema::hasColumn('users', 'kecamatan')) {
                $table->string('kecamatan',30)->nullable();
            }
            if (!Schema::hasColumn('users', 'kelurahan')) {
                $table->string('kelurahan',30)->nullable();
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable();
            }
            if (!Schema::hasColumn('users', 'isadmin')) {
                $table->integer('isadmin')->nullable()->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
