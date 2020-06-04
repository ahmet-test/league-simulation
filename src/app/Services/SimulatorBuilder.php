<?php

namespace App\Services;

use App\Fixture;
use App\Team;
use App\TeamStatus;

class SimulatorBuilder
{
    private $teams;

    /**
     * SimulatorService constructor.
     * @param array $teams
     */
    public function __construct(array $teams)
    {
        $this->teams = $teams;
        $this->prepare();
    }

    /**
     * @return $this
     */
    public function generateTeams()
    {
        try {
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
        } catch (\Exception $e) {
            # logging
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function generateFixture()
    {
        $teams = Team::all()->toArray();
        $total = count($teams);

        if ($total === 0) {
            return false;
        }

        $week = 0;

        $randomWeek = range(1, $total * ($total - 1));
        shuffle($randomWeek);

        for ($i = 0; $i < $total; $i++) {
            $teamMap = [$teams];
            unset($teamMap[0][$i]);

            foreach (current($teamMap) as $map) {
                $match = new Fixture();
                $match->setAttribute('week', $randomWeek[$week++]);
                $match->setAttribute('home_team', $teams[$i]['id']);
                $match->setAttribute('away_team', $map['id']);
                $match->save();
            }
        }

        return true;
    }

    private function prepare()
    {
        Fixture::query()->delete();
        TeamStatus::query()->delete();
        Team::query()->delete();
    }

}
