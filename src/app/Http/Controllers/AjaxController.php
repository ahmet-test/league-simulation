<?php

namespace App\Http\Controllers;

use App\Services\FixtureService;
use App\Services\SimulatorBuilder;
use App\Team;

class AjaxController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function launchGame()
    {
        $simulatorService = new SimulatorBuilder(Team::DEFAULT_TEAMS);

        return response()->json(
            $simulatorService
                ->generateTeams()
                ->generateFixture()
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function playNextMatch()
    {
        return response()->json(
            FixtureService::getInstance()->playMatch()
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        return view('ajax/list', [
            'teams' => FixtureService::getInstance()->getLeagueTable(),
            'nextMatch' => FixtureService::getInstance()->getNextMatch(),
        ]);
    }
}
