<?php

namespace App\Http\Resources\scoreboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\stats\SkaterResource;
use App\Http\Resources\stats\GoalieResource;
use App\Http\Resources\stats\TeamResource;

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
            'playerName' => $this->first_name. ' ' .$this->last_name,
            'playerAbbv' => $this->when(
                $this->position != 'T', substr($this->first_name, 0, 1). '. ' .$this->last_name
            ),
            'playerAbbvTeam' => $this->when(
                $this->position === 'T', $this->last_name
            ),
            'playsFor' => $this->plays_for,
            'position' => $this->position,
            'isInjured' => $this->injury_status,
            'lineup' => $this->lineup,
            'schedule' => new ScheduleResource($this->schedule),
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
            return new SkaterResource($this->statsWeek);
        }

        if ($position ===  'G') {
            return new GoalieResource($this->statsWeek);
        }

        if ($position ===  'T') {
            return new TeamResource($this->statsWeek);
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
