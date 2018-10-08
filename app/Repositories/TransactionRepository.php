<?php

namespace App\Repositories;

use App\Models\Player;
use App\Models\Lineup;
use App\Models\Movement;
use App\Models\Trade;
use App\Models\Tradable;
use App\Models\TradePlayerPick;

/**
 *
 */

class TransactionRepository
{
    public function drop($player_id, $user_id, $week)
    {
        Player::where('id', '=', $player_id)
            ->update([
                'franchise_id' => 9,
                'draft' => 'fa',
                'contract' => 0,
                'cap_hit' => 0,
                'rookie_status' => 'n',
                'keeper' => 0,
                'block' => 0
            ]);

        Lineup::where('player_id', '=', $player_id)
            ->where('week_id', '>=', $week)
            ->update([
                'franchise_id' => 0,
                'dress' => 0,
                'bench' => 0,
                'injury' => 0,
                'farm' => 0
            ]);

        Movement::insert([
            'franchise_id' => $user_id,
            'player_id' => $player_id,
            'type' => 'drop'
        ]);
    }

    public function add($player_id, $user_id, $week)
    {
        Player::where('id', '=', $player_id)
            ->update([
                'franchise_id' => $user_id,
                'contract' => 1
            ]);

        Lineup::where('player_id', '=', $player_id)
            ->where('week_id', '>=', $week)
            ->update([
                'franchise_id' => $user_id,
                'bench' => 1,
            ]);

        Movement::insert([
            'franchise_id' => $user_id,
            'player_id' => $player_id,
            'type' => 'add'
        ]);
    }

    public function trade($offered_by, $offered_to, $players, $picks)
    {
        $trade = new Trade;
        $trade->open = 1;
        $trade->offered_by = $offered_by;
        $trade->offered_to = $offered_to;
        $trade->created_at = now();
        $trade->updated_at = now();
        $trade->save();

        $this->tradePick($trade->id, $picks);
        $this->tradePlayer($trade->id, $players);
    }


    public function tradePick($trade_id, $picks)
    {
        foreach ($picks as $pick) {
            $tradable = new Tradable;
            $tradable->trade_id = $trade_id;
            $tradable->tradable_id = $pick;
            $tradable->tradable_type = 'App\Models\Pick';
            $tradable->save();
        }
    }

    public function tradePlayer($trade_id, $players)
    {
        foreach ($players as $player) {
            $tradable = new Tradable;
            $tradable->trade_id = $trade_id;
            $tradable->tradable_id = $player;
            $tradable->tradable_type = 'App\Models\Player';
            $tradable->save();
        }
    }
}
