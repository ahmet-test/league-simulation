<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    public const MATCH_RESULT_STATES = [
        'won_home',
        'won_away',
        'drawn',
    ];

    public const WON_HOME = 'won_home';
    public const WON_AWAY = 'won_away';
    public const DRAWN = 'drawn';

    protected $table = 'fixture';

    /**
     * @var array
     */
    protected $fillable = [
        'week', 'home_team', 'away_team', 'result'
    ];

}
