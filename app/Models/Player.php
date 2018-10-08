<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Filters\FiltersPlayers;

class Player extends Model
{
    protected $table = 'players';

    public $timestamps = false;

    protected $appends = [
        'player_age',
        'player_height',
        'plays_for'
    ];

    public function scopeFilter(Builder $builder, $request, array $filters = [])
    {
        return (new FiltersPlayers($request))->filter($builder);
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function statsWeek()
    {
        return $this->hasOne(stats\Week::class);
    }

    public function statsLast()
    {
        return $this->hasOne(stats\Last::class);
    }

    public function statsTwo()
    {
        return $this->hasOne(stats\Two::class);
    }

    public function schedule()
    {
        return $this->hasMany(schedule\Week::class, 'team', 'plays_for');
    }

    public function scheduleNext()
    {
        return $this->hasMany(schedule\Next::class, 'team', 'plays_for');
    }

    public function lineup()
    {
        return $this->hasOne(Lineup::class);
    }

    public function scout()
    {
        return $this->hasOne(Scout::class);
    }

    // public function trade()
    // {
    //     return $this->morphToMany(Trade::class, 'tradable');
    // }

    public function getPlayerAgeAttribute()
    {
        $birth_date = str_replace("-", " ", $this->birth_date);
        $date = explode(" ", $birth_date);

        return Carbon::createFromDate($date[0], $date[1], $date[2])->age;
    }

    public function getPlayerHeightAttribute()
    {
        $feet = $this->height / 12;
        $inch = $this->height % 12;

        return sprintf('%d\' %d\'', $feet, $inch);
    }

    public function getPlaysForAttribute()
    {
        return substr($this->nhl, -3, 3);
    }
}
