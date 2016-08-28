<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_name_id');
            $table->string('course_category');
            $table->integer('users_teacher_id');
            $table->integer('class_id');
            $table->timestamps();
        });

        Schema::table('courses',function($table) {
            $table->foreign('courses_name_id')->references('courses_name')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
    }
}
