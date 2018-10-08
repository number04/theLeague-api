<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $table = 'weeks';

    protected $dates = ['start_date', 'end_date'];

    public $timestamps = false;

    protected $hidden = [
        'id', 'start_date', 'end_date'
    ]; 

    protected $appends = ['date'];

    // public function matchup()
    // {
    //     return $this->hasOne(Matchup::class);
    // }

    public function getDateAttribute()
    {
        return $this->start_date->format('d M') . ' - ' . $this->end_date->format('d M');
    }
}
