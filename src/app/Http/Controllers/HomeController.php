<?php

namespace App\Http\Controllers;

use App\Team;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $teams = Team::with('status')->get();

        return view('home/index', ['teams' => $teams]);
    }
}
