<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Standing;

class StandingResource extends JsonResource
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
            'matchupId' => $this->matchup_id,
            'goals' => $this->goals,
            'assists' => $this->assists,
            'points' => $this->points,
            'hits' => $this->hits,
            'shots' => $this->shots,
            'faceoffWins'=> $this->faceoff_wins,
            'saves' => $this->saves,
            'savePercentage' => $this->save_percentage,
            'goalsAgainstAverage' => $this->goals_against_average,
            'team' => $this->team + 0,
            'skater' => (
                $this->goals +
                $this->assists +
                $this->points +
                $this->hits +
                $this->shots
            ),

            'goalie' => (
                $this->saves +
                $this->save_percentage +
                $this->goals_against_average
            ),

            'total' => (
                $this->goals +
                $this->assists +
                $this->points +
                $this->hits +
                $this->shots +
                $this->saves +
                $this->save_percentage +
                $this->goals_against_average +
                $this->team
            )
        ];
    }
}
