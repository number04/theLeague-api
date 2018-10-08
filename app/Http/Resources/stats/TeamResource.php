<?php

namespace App\Http\Resources\stats;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'gamesPlayed' => $this->games_played,
            'wins' => $this->wins,
            'losses' => $this->losses,
            'overtimeLosses' => $this->overtime_losses,
            'points' => ($this->wins * 2) + $this->overtime_losses,
            'goalsFor' => $this->goals_for,
            'goalsAgainst' => $this->goals_against
        ];
    }
}
