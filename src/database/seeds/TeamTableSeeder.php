<?php

use App\Team;
use App\TeamStatus;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    private $teams = [
        'Liverpool',
        'Manchester City',
        'Tottenham',
        'Chelsea',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->teams as $team) {

            $teamModel = new Team();
            $teamModel->setAttribute('name', $team);
            $teamModel->setAttribute('power', random_int(1, 100));
            $teamModel->setAttribute('morale', random_int(1, 10));
            $teamModel->save();

            $teamStatuses = new TeamStatus();
            $teamStatuses->setAttribute('team_id', $teamModel->id);
            $teamStatuses->setAttribute('points', 0);
            $teamStatuses->setAttribute('played', 0);
            $teamStatuses->setAttribute('won', 0);
            $teamStatuses->setAttribute('drawn', 0);
            $teamStatuses->setAttribute('lost', 0);
            $teamStatuses->setAttribute('goal_difference', 0);
            $teamStatuses->save();
        }

    }
}
