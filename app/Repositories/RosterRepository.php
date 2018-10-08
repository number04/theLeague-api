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
    public function block($id, $value)
    {
        Player::where('id', '=', $id)
            ->update([
                'block' => $value
            ]);
    }

    public function keeper($id, $value)
    {
        Player::where('id', '=', $id)
            ->update([
                'keeper' => $value
            ]);
    }

    public function scout($player_id, $column, $value)
    {
        Scout::where('player_id', '=', $player_id)
            ->update([
                $column => $value
            ]);
    }

    public function cap($user_id, $id, $value, $cap)
    {
        if ($value === 1) {
            Franchise::where('id', '=', $user_id)
                ->increment('cap_hit', $cap);
        } else {
            Franchise::where('id', '=', $user_id)
                ->decrement('cap_hit', $cap);
        }
    }

    public function need($franchise_id, $need, $value)
    {
        Need::where('franchise_id', '=', $franchise_id)
            ->update ([
                $need => $value
            ]);
    }

    // public function need($user_id, $pick, $center, $left_wing, $right_wing, $defence, $goalie, $team)
    // {
    //     DB::table ('needs')
    //     ->where ('franchise_id', '=', $user_id)
    //     ->update ([
    //         'pick' => $pick,
    //         'center' => $center,
    //         'left_wing' => $left_wing,
    //         'right_wing' => $right_wing,
    //         'defence' => $defence,
    //         'goalie' => $goalie,
    //         'team' => $team
    //     ]);
    // }
}
