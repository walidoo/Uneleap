<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('library_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filter',50);
            $table->tinyInteger('type')->comment('0 for Tags, 1 For Countries, 2 For Universities, 3 For Major Courses');
            $table->integer('library_id')->unsigned();
            $table->foreign('library_id')->references('id')->on('libraries')->onDelete('cascade');
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
         Schema::dropIfExists('library_filters');
    }
}
