<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LineupRepository;
use App\Repositories\LimitRepository\Limit;

class LineupController extends Controller
{
    public function lineup(Request $request, LineupRepository $lineup, Limit $limit)
    {
        $limit->count($request->players);

        foreach ($request->players as $player) {
            $lineup->update(
                $player['playerId'],
                $request->week,
                $player['lineup']['dress'],
                $player['lineup']['bench'],
                $player['lineup']['injury'],
                $player['lineup']['farm'],
                $request->franchise_id
            );
        }
    }
}
