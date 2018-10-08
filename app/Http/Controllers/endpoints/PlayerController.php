<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\PlayersResource;

class PlayerController extends Controller
{
    private function player($week, $position)
    {
        return Player::with([
            'scout',
            'statsWeek' => function ($query) use ($week) {
                if ($week > 0) {
                    $query->where('week_id', '=', ($week));
                } else {
                    $query->where('week_id', '=', 10);
                }
            },

            'statsLast' => function ($query) use ($week) {
                if ($week > 1) {
                    $query->where('week_id', '=', ($week - 1));
                } else {
                    $query->where('week_id', '=', 10);
                }
            },

            'statsTwo' => function ($query) use ($week) {
                if ($week > 2) {
                    $query->where('week_id', '=', ($week - 2));
                } else {
                    $query->where('week_id', '=', 10);
                }
            },

            'schedule' => function ($query) use ($week) {
                if ($week < 1) {
                    $query->where('week_id', '=', $week + 1);
                } else {
                    $query->where('week_id', '=', $week);
                }
            },

            'scheduleNext' => function ($query) use ($week) {
                $query->where('week_id', '=', $week + 1);
            },

            'lineup' => function ($query) use ($week) {
                $query->where('week_id', '=', $week);
            }
        ])
            ->whereIn('position', $position);
    }

    public function players($week, Request $request)
    {
        return PlayersResource::collection($this->player($week, ['C', 'R', 'L', 'D', 'G'])->filter($request)->paginate(20));
    }

    public function skater($week, $player)
    {
        return PlayerResource::collection($this->player($week, ['C', 'R', 'L', 'D'])->where('id', '=', $player)->get());
    }

    public function goalie($week, $player)
    {
        return PlayerResource::collection($this->player($week, ['G'])->where('id', '=', $player)->get());
    }

    public function team($week, $player)
    {
        return PlayerResource::collection($this->player($week, ['T'])->where('id', '=', $player)->get());
    }
}
