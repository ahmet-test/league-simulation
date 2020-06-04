<?php

use App\Services\SimulatorBuilder;
use App\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $simulatorService = new SimulatorBuilder(Team::DEFAULT_TEAMS);
        $simulatorService->generateTeams()->generateFixture();
    }
}
