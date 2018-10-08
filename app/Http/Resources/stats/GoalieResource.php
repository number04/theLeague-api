<?php

namespace App\Http\Resources\stats;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalieResource extends JsonResource
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
            'saves' => $this->saves,
            'savePercentage' => $this->save_percentage,
            'goalsAgainstAverage' => $this->goals_against_average
        ];
    }
}
