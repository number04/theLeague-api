<?php

namespace App\Models\stats;

use Illuminate\Database\Eloquent\Model;

class Two extends Model
{
    protected $table = 'stats_weeks';

    public $timestamps = false;

    protected $appends = [
        'goals_against_average',
        'save_percentage'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function getGoalsAgainstAverageAttribute()
    {
        if ($this->time_on_ice != 0) {
            return number_format(round(($this->goals_against * 3600) / $this->time_on_ice, 2), 2);
        }

        return 0;
    }

    public function getSavePercentageAttribute()
    {
        if ($this->saves != 0) {
            return ltrim(number_format(round($this->saves / ($this->saves + $this->goals_against), 3), 3), '0');
        }

        return 0;
    }
}
