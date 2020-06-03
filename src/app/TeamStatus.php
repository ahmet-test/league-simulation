<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamStatus extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'team_id', 'points', 'played', 'won', 'drawn', 'lost', 'goal_difference'
    ];

}
