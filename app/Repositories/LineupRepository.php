<?php

namespace App\Repositories;

use App\Models\Lineup;

/**
 *
 */

class LineupRepository
{    
    public function update($player_id, $week, $dress, $bench, $injury, $farm, $franchise)
    {
        return Lineup::where('player_id', '=', $player_id)
            ->where('week_id', '>=', $week)
            ->update([
                'dress' => $dress,
                'bench' => $bench,
                'injury' => $injury,
                'farm' => $farm,
                'franchise_id' => $franchise
            ]);
    }
}