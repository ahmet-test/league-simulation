<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public const DEFAULT_TEAMS = [
        'Liverpool',
        'Manchester City',
        'Tottenham',
        'Chelsea',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'power', 'morale'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(TeamStatus::class);
    }

}
