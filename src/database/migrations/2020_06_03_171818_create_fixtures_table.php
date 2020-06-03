<?php

use App\fixture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixture', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('week');
            $table->unsignedInteger('home_team');
            $table->unsignedInteger('away_team');
            $table->enum('result', fixture::MATCH_RESULT_STATES);
            $table->timestamps();

            $table->foreign('home_team')->references('id')->on('teams');
            $table->foreign('away_team')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixture');
    }
}
