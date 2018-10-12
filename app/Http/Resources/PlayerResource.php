<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'playerId' => $this->id,
            'franchiseId' => $this->franchise_id,
            'playerName' => $this->first_name . ' ' . $this->last_name,
            'position' => $this->position,
            'playsFor' => $this->plays_for,
            'capHit' => $this->cap_hit,
            'keeper' => $this->keeper,
            'draftContract' => $this->draft . '-' . $this->contract,
            'hometown' => [
                'na' => $this->when(
                    $this->birth_province != '',
                    $this->birth_city . ', ' . $this->birth_province . ' ' . $this->birth_country
                ),

                'world' => $this->when(
                    $this->birth_province === '',
                    $this->birth_city . ', ' . $this->birth_country
                )
            ],
            'age' => $this->player_age,
            'height' => $this->player_height,
            'weight' => $this->weight,
            'isRookie' => $this->rookie_status,
            'isInjured' => $this->injury_status,
            'scheduleWeek' => new ScheduleResource($this->schedule),
            'scheduleNext' => new ScheduleResource($this->scheduleNext),
            'stats' => $this->stats($this->position),
        ];
    }

    private function stats($position)
    {
        if ($position != 'G' && $position != 'T' ) {
            return [
                'total' => [
                    'gamesPlayed' => $this->games_played,
                    'goals' => $this->goals,
                    'assists' => $this->assists,
                    'points' => $this->goals + $this->assists,
                    'hits' => $this->hits,
                    'shots' => $this->shots,
                    'faceoffWins' => $this->faceoff_wins
                ],
                'week' => new stats\SkaterResource($this->statsWeek),
                'lastWeek' => new stats\SkaterResource($this->statsLast),
                'lastTwoWeek' => new stats\SkaterResource($this->statsTwo)
            ];
        }

        if ($position ===  'G') {
            return [
                'total' => [
                    'gamesPlayed' => $this->games_played,
                    'wins' => $this->wins,
                    'losses' => $this->losses,
                    'overtimeLosses' => $this->overtime_losses,
                    'saves' => $this->saves,
                    'savePercentage' => ltrim($this->save_percentage, '0'),
                    'goalsAgainstAverage' => $this->goals_against_average
                ],
                'week' => new stats\GoalieResource($this->statsWeek),
                'lastWeek' => new stats\GoalieResource($this->statsLast),
                'lastTwoWeek' => new stats\GoalieResource($this->statsTwo)
            ];
        }

        if ($position ===  'T') {
            return [
                'total' => [
                    'gamesPlayed' => $this->games_played,
                    'wins' => $this->wins,
                    'losses' => $this->losses,
                    'overtimeLosses' => $this->overtime_losses,
                    'points' => ($this->wins * 2) + $this->overtime_losses,
                    'goalsFor' => $this->goals_for,
                    'goalsAgainst' => $this->goals_against
                ],
                'week' => new stats\TeamResource($this->statsWeek),
                'lastWeek' => new stats\TeamResource($this->statsLast),
                'lastTwoWeek' => new stats\TeamResource($this->statsTwo)
            ];
        }
    }
}
