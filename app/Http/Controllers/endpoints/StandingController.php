<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Standing;
use App\Http\Resources\StandingResource;

class StandingController extends Controller
{
    public function index($week)
    {
        return StandingResource::collection(Standing::where('matchup_id', '<' , $week)->get())->additional([
            'standing' => [
                $this->standing(1),
                $this->standing(2),
                $this->standing(3),
                $this->standing(4),
                $this->standing(5),
                $this->standing(6),
                $this->standing(7),
                $this->standing(8)
            ]
        ]);
    }

    private function franchise($franchise)
    {
        return Franchise::where('id', $franchise)->pluck('franchise_name')->first();
    }

    private function stat($franchise, $stat)
    {
        return number_format(Standing::where('franchise_id', $franchise)->sum($stat), 1);
    }

    private function skater($franchise)
    {
        return (
            $this->stat($franchise, 'goals') +
            $this->stat($franchise, 'assists') +
            $this->stat($franchise, 'points') +
            $this->stat($franchise, 'hits') +
            $this->stat($franchise, 'shots') +
            $this->stat($franchise, 'faceoff_wins')
        );
    }

    private function goalie($franchise)
    {
        return (
            $this->stat($franchise, 'saves') +
            $this->stat($franchise, 'save_percentage') +
            $this->stat($franchise, 'goals_against_average')
        );
    }

    private function team($franchise)
    {
        return (
            $this->stat($franchise, 'team') + 0
        );
    }

    private function total($franchise)
    {
        return (
            $this->stat($franchise, 'goals') +
            $this->stat($franchise, 'assists') +
            $this->stat($franchise, 'points') +
            $this->stat($franchise, 'hits') +
            $this->stat($franchise, 'shots') +
            $this->stat($franchise, 'faceoff_wins') +
            $this->stat($franchise, 'saves') +
            $this->stat($franchise, 'save_percentage') +
            $this->stat($franchise, 'goals_against_average') +
            $this->stat($franchise, 'team')

        );
    }

    private function standing($franchise)
    {
        return  [
            'franchiseId' => $franchise,
            'franchiseName' => $this->franchise($franchise),
            'goals' => $this->stat($franchise, 'goals'),
            'assists' => $this->stat($franchise, 'assists'),
            'points' => $this->stat($franchise, 'points'),
            'hits' => $this->stat($franchise, 'hits'),
            'shots' => $this->stat($franchise, 'shots'),
            'faceoffWins' => $this->stat($franchise, 'faceoff_wins'),
            'saves' => $this->stat($franchise, 'saves'),
            'savePercentage' => $this->stat($franchise, 'save_percentage'),
            'goalsAgainstAverage' => $this->stat($franchise, 'goals_against_average'),
            'team' => $this->team($franchise),
            'skater' => $this->skater($franchise),
            'goalie' => $this->goalie($franchise),
            'total' => $this->total($franchise)
        ];
    }
}
