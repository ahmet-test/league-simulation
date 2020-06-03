<?php

use App\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            DB::table('teams')->insert([
                'name' => $team,
                'power' => random_int(1, 90),
                'morale' => random_int(30, 100),
            ]);
        }

    }
}
