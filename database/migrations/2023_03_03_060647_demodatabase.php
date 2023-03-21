<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function($table){
            $table->increments('id');
            $table->string('name',200)->unique();
            $table->longtext('description');
        });

        Schema::create('courses', function($table){
            $table->increments('id');
            $table->string('name',200)->unique();
            $table->longtext('description');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('topics', function($table){
            $table->increments('id');
            $table->string('name',200)->unique();
            $table->longtext('description');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::create('roles', function($table){
            $table->increments('id');
            $table->string('name',200)->unique();
            $table->longtext('description');
        });

        Schema::create('human_resources', function($table){
            $table->increments('id');
            $table->string('username',200)->unique();
            $table->string('password',200)->nullable();
            $table->string('name',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('phone',200)->nullable();
            $table->string('department',200)->nullable();
            $table->string('type',200)->nullable();
            $table->string('education',200)->nullable();
            $table->string('age',3)->nullable();
            $table->string('DoB',10)->nullable();
            $table->string('address',100)->nullable();
            $table->string('toeic_score',200)->nullable();
            $table->string('main_programming_language',200)->nullable();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });

        Schema::create('assigned_courses', function($table){
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->integer('trainee_id')->unsigned();
            $table->foreign('trainee_id')->references('id')->on('human_resources');
        });

        Schema::create('assigned_topics', function($table){
            $table->increments('id');
            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->integer('trainer_id')->unsigned();
            $table->foreign('trainer_id')->references('id')->on('human_resources');
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
};
