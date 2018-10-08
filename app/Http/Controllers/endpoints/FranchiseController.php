<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Http\Resources\FranchiseResource;

class FranchiseController extends Controller
{
    private function franchise($week)
    {
        return Franchise::with([
            'need',
            'player',
            'player.statsWeek' => function ($query) use ($week) {
                $query->where('week_id', '=', ($week));

            },
            'player.lineup' => function ($query) use ($week) {
                $query->where('week_id', '=', $week);
            },
            'player.schedule' => function ($query) use ($week) {
                $query->where('week_id', '=', $week);
            },
            'pick' => function ($query) {
                $query->orderBy('round', 'ASC');
            }
        ])->orderBy('id', 'ASC');
    }

    public function index($week)
    {
        return FranchiseResource::collection($this->franchise($week)->get());
    }

    public function show($week, $franchise)
    {
        return FranchiseResource::collection($this->franchise($week)->where('id', '=', $franchise)->get());
    }
}
