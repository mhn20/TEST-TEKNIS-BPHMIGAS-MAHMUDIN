<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifikasiEmailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'keyverif')) {
                $table->longText('keyverif');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->integer('status');
            }
            if (!Schema::hasColumn('users', 'isverif')) {
                $table->integer('isverif');
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
