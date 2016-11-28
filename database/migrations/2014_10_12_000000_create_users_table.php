<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('user_name', 50)->nullable()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country', 100);
            $table->string('gender', 20);
            $table->string('university', 100)->nullable();
            $table->string('university_id', 15)->nullable();
            $table->string('degree', 100)->nullable();
            $table->string('type', 15)->nullable();
            $table->string('job_title', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->longText('profile_summary')->nullable();
            $table->tinyInteger('user_type');
            $table->tinyInteger('privacy')->default(1);
            $table->tinyInteger('status')->default(1);
             $table->string('language', 100)->nullable();
            $table->string('profile_picture_path', 255)->nullable();
            $table->string('profile_picture_filename', 100)->nullable();

            $table->string('profile_cover_path', 255)->nullable();
            $table->string('profile_cover_filename', 100)->nullable();

            $table->integer('university_list_id')->unsigned()->nullable();
            $table->integer('course_list_id')->unsigned()->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
