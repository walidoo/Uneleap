<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->longText('description');
            $table->string('cover',255)->nullable();
            $table->string('cover_extension',10)->nullable();
            $table->string('cover_filename',100)->nullable();
            $table->string('attachment',255)->nullable();
            $table->string('attachment_extension',10)->nullable();
            $table->string('attachment_filename',100)->nullable();
            $table->string('author', 100);
            $table->tinyInteger('privacy')->comment('0 for Public, 1 For Private, 2 For Followers');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
         Schema::dropIfExists('libraries');
    }
}
