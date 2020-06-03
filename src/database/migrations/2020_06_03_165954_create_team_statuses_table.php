<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned()->nullable();
            $table->unsignedTinyInteger('points');
            $table->unsignedTinyInteger('played');
            $table->unsignedTinyInteger('won');
            $table->unsignedTinyInteger('drawn');
            $table->unsignedTinyInteger('lost');
            $table->unsignedMediumInteger('goal_difference');
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_statuses');
    }
}
