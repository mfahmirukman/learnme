<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('courses_id')->unsigned();
            $table->integer('user_id')->unsigned();
            
            $table->text('title');
            $table->text('body');
            $table->timestamps();
        });

        Schema::table('threads', function($table) {
            $table->foreign('courses_id')->references('courses')->on('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('threads');
    }
}
