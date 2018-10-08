<?php

namespace App\Http\Resources\stats;

use Illuminate\Http\Resources\Json\JsonResource;

class SkaterResource extends JsonResource
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
            'goals' => $this->goals,
            'assists' => $this->assists,
            'points' => $this->goals + $this->assists,
            'hits' => $this->hits,
            'shots' => $this->shots,
            'faceoffWins' => $this->faceoff_wins
        ];
    }
}
