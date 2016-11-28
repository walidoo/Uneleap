<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityInfosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('university_infos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->longText('description1')->nullable();
            $table->longText('description2')->nullable();
            $table->longText('description3')->nullable();

            $table->string('tag_line', 255)->nullable();
            $table->string('website', 255)->nullable();
            
            $table->string('cover', 255)->nullable();
            $table->string('cover_filename', 100)->nullable();
            $table->string('profile', 255)->nullable();
            $table->string('profile_filename', 100)->nullable();


            $table->integer('university_id')->unsigned();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
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
    public function down() {
        Schema::dropIfExists('university_infos');
    }

}
