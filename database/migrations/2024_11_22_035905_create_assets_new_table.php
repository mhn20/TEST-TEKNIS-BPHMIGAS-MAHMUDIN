<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('assets');
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('work_id',50)->nullable();
            $table->string('new_rev',50)->nullable();
            $table->string('ori_ver',50)->nullable();
            $table->string('title',100)->nullable();
            $table->string('iswc',100)->nullable();
            $table->text('performer')->nullable();
            $table->string('isrc',100)->nullable();
            $table->text('link_youtube_official')->nullable();
            $table->text('link_youtube_others')->nullable();
            $table->text('link_audio')->nullable();
            $table->text('link_lainnya')->nullable();
            $table->string('lyricist',50)->nullable();
            $table->string('arrange',50)->nullable();
            $table->string('publisher',50)->nullable();
            $table->string('cover_art')->nullable();
            $table->boolean('notasi')->default(false)->nullable();
            $table->boolean('lirik')->default(false)->nullable();
            $table->boolean('iskontrak')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
