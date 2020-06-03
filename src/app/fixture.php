<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fixture extends Model
{
    public const MATCH_RESULT_STATES = [
        'won',
        'drawn',
        'lost',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'week', 'home_team', 'away_team', 'result'
    ];

}
