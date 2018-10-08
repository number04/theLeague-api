<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PlayersResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'playerId' => $this->id,
            'playerName' => $this->first_name. ' ' .$this->last_name,
            'playerAbbv' => $this->when(
                $this->position != 'T', substr($this->first_name, 0, 1). '. ' .$this->last_name
            ),
            'playerAbbvTeam' => $this->when(
                $this->position === 'T', $this->last_name
            ),
            'franchiseId' => $this->franchise_id,
            'playsFor' => $this->plays_for,
            'position' => $this->position,
            'keeper' => $this->keeper,
            'block' => $this->block,
            'capHit' => $this->cap_hit,
            'draftContract' => $this->draft. '-' .$this->contract,
            'isRookie' => $this->rookie_status,
            'isInjured' => $this->injury_status,
            'lineup' => $this->lineup,
            'schedule' => new ScheduleResource($this->schedule),
            'scout' => $this->scout,
            'stats' => $this->stats($this->position),
            'href' => $this->href($this->position),
        ];
    }

    private function week()
    {
        return DB::table('status')->where('name', '=', 'week')->first()->value;
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
                'week' => new stats\SkaterResource($this->statsWeek)
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
                'week' => new stats\GoalieResource($this->statsWeek)
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
                'week' => new stats\TeamResource($this->statsWeek)
            ];
        }
    }

    private function href($position)
    {
        if ($position != 'G' && $position != 'T' ) {
            return route('skater', ['week' => $this->week(), 'player' => $this->id]);
        }

        if ($position ===  'G') {
            return route('goalie', ['week' => $this->week(), 'player' => $this->id]);
        }

        if ($position ===  'T') {
            return route('team', ['week' => $this->week(), 'player' => $this->id]);
        }
    }
}
