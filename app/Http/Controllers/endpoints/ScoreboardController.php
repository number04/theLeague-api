<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Http\Resources\scoreboard\ScoreboardResource;

class ScoreboardController extends Controller
{
    private function franchise($week)
    {
        return Franchise::with([
            'lineup' => function ($query) use ($week) {
                $query->where('week_id', '=', ($week));

            },
            'lineup.player',
            'lineup.player.statsWeek' => function ($query) use ($week) {
                $query->where('week_id', '=', ($week));

            },
            'lineup.player.lineup' => function ($query) use ($week) {
                $query->where('week_id', '=', $week);
            },
            'lineup.player.schedule' => function ($query) use ($week) {
                $query->where('week_id', '=', $week);
            }
        ])->orderBy('id', 'ASC');
    }

    public function index($week)
    {
        return ScoreboardResource::collection($this->franchise($week)->get());
    }
}
