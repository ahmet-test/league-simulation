<?php

namespace App\Services;

use App\Fixture;
use App\Team;
use Illuminate\Support\Facades\DB;

class FixtureService
{
    private static $instance;

    /**
     * FixtureService constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return FixtureService
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new FixtureService();
        }

        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getNextMatch()
    {
        return Fixture::whereNull('result')
            ->orderBy('week')
            ->first();
    }

    /**
     * @return array
     */
    public function getLeagueTable()
    {
        return Team::with('status')->get()->keyBy('id')->toArray();
    }

    /**
     * @return array|int
     * @throws \Exception
     */
    public function playMatch()
    {
        $currentMatch = $this->getNextMatch();
        if ($currentMatch === null) {
            return -1;
        }

        $teamHome = Team::all()->where('id', $currentMatch->home_team)->first();
        $teamAway = Team::all()->where('id', $currentMatch->away_team)->first();

        return $this->exec($currentMatch, $teamHome, $teamAway);
    }

    /**
     * @param $match
     * @param $home
     * @param $away
     * @return array
     * @throws \Exception
     */
    private function exec($match, $home, $away)
    {
        $teamHomeRate = $home->power * (random_int(1, 10) * $home->morale) * 2;
        $teamAwayRate = $away->power * (random_int(1, 10) * $away->morale);
        $awayGoal = random_int(0, $teamAwayRate / (1 * 520));
        $homeGoal = random_int(0, $teamHomeRate / (1 * 520));

        ++$home->status->played;
        ++$away->status->played;

        $away->status->goal_difference += $homeGoal;
        $home->status->goal_difference += $awayGoal;

        if ($homeGoal === $awayGoal) {
            $match->result = Fixture::DRAWN;
            ++$home->status->points;
            ++$away->status->points;
            ++$away->status->drawn;
            ++$home->status->drawn;
            $result = 0;
        } elseif ($homeGoal > $awayGoal) {
            $match->result = Fixture::WON_HOME;
            $home->status->points += 3;
            ++$home->status->won;
            ++$away->status->lost;
            $result = 1;
        } else {
            $match->result = Fixture::WON_AWAY;
            $away->status->points += 3;
            ++$away->status->won;
            ++$home->status->lost;
            $result = 2;
        }

        try {
            DB::beginTransaction();

            $home->status->save();
            $away->status->save();
            $match->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return [
            'result' => $result,
            'homeTeamGoal' => $homeGoal,
            'awayTeamGoal' => $awayGoal,
        ];
    }

}
