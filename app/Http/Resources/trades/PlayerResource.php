<?php

namespace App\Http\Resources\trades;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'franchiseId' => $this->franchise_id,
            'playerName' => $this->first_name . ' ' . $this->last_name,
            'position' => $this->position,
            'playsFor' => $this->plays_for,
            'isInjured' => $this->injury_status,
            'href' => [
                'skater' => $this->when(
                    $this->position(), route(
                        'skater', ['week' => $this->week(), 'player' => $this->id]
                    )
                ),
                'goalie' => $this->when(
                    $this->position === 'G',route(
                        'goalie', ['week' => $this->week(), 'player' => $this->id]
                    )
                ),
                'team' => $this->when(
                    $this->position === 'T', route(
                        'team', ['week' => $this->week(), 'player' => $this->id]
                    )
                ),
            ]
        ];
    }

    private function week()
    {
        return DB::table('status')->where('name', '=', 'week')->first()->value;
    }

    private function position()
    {
        return $this->position === 'C' || $this->position === 'R' || $this->position === 'L' || $this->position === 'D';
    }
}
