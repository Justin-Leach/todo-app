<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('priority');
            $table->integer('importance');
            $table->string('description');

            $table->unsignedBigInteger('status_id');

            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('team_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('task_status');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
