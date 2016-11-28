<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Followers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('follower_id')->unsigned();
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('following_id')->unsigned();
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(0)->comment('1 for Pending, 2 For Approved, 3 For Rejected');
            $table->Integer('attempts')->default(0);
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
         Schema::dropIfExists('followers');
    }
}
