<?php

namespace App\Repositories;

use DB;
use App\Models\Scout;
use App\Models\Player;
use App\Models\Franchise;
use App\Models\Need;

/**
 *
 */

class RosterRepository
{

    public function manage($id, $column)
    {
        Player::where('id', '=', $id)
            ->update([
                $column => DB::raw('CASE WHEN '. $column .' = 1 THEN 0 WHEN '. $column .' = 0 THEN 1 ELSE NULL END')
            ]);
    }

    public function scout($id, $column)
    {
        Scout::where('player_id', '=', $id)
            ->update([
                $column => DB::raw('CASE WHEN `'. $column .'` = 1 THEN 0 WHEN `'. $column .'` = 0 THEN 1 ELSE NULL END')
            ]);
    }

    public function need($id, $column)
    {
        Need::where('franchise_id', '=', $id)
            ->update ([
                $column => DB::raw('CASE WHEN `'. $column .'` = 1 THEN 0 WHEN `'. $column .'` = 0 THEN 1 ELSE NULL END')
            ]);
    }

    public function cap($user_id, $id, $value, $cap)
    {
        if ($value === 0) {
            return Franchise::where('id', '=', $user_id)->increment('cap_hit', $cap);
        }

        return Franchise::where('id', '=', $user_id)->decrement('cap_hit', $cap);
    }
}
