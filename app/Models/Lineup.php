<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    protected $table = 'lineups';

    public $timestamps = false;

    protected $hidden = [
        'player_id', 'franchise_id', 'week_id'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

}
