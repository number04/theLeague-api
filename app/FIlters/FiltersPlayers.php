<?php

namespace App\Filters;

use App\Filters\FiltersAbstract;

use App\Filters\players\{
    Position, Status, NHL, Scout, Franchises
};

use App\Filters\stats\{
    GamesPlayed, Goals, Assists, Points, Hits, Shots, Faceoffs, Wins, Losses, Overtime, Saves, Percentage, Average
};

class FiltersPlayers extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'position' => Position::class,
        'status' => Status::class,
        'nhl' => NHL::class,
        'scout' => Scout::class,
        'franchise' => Franchises::class,
        'played' => GamesPlayed::class,
        'goals' => Goals::class,
        'assists' => Assists::class,
        'points' => Points::class,
        'hits' => Hits::class,
        'shots' => Shots::class,
        'faceoffs' => Faceoffs::class,
        'wins' => Wins::class,
        'losses' => Losses::class,
        'overtime' => Overtime::class,
        'saves' => Saves::class,
        'percentage' => Percentage::class,
        'average' => Average::class,
    ];
}
