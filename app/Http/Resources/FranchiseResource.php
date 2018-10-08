<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FranchiseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd();

        return [
            'franchiseId' => $this->id,
            'franchiseName' => $this->franchise_name,
            'franchiseTag' => $this->franchise_tag,
            'cap' => $this->cap_hit,
            'needs' => $this->need,
            'scoreboard' => [
                'skaters' => [
                    'gamesPlayed' => $this->skater('games_played'),
                    'goals' => $this->skater('goals'),
                    'assists' => $this->skater('assists'),
                    'points' => $this->skater('goals') + $this->skater('assists'),
                    'hits' => $this->skater('hits'),
                    'shots' => $this->skater('shots'),
                    'faceoffWins' => $this->skater('faceoff_wins')
                ],
                'goalies' => [
                    'gamesPlayed' => $this->goalie('games_played'),
                    'saves' => $this->goalie('saves'),
                    'savePercentage' => $this->savePercentage(),
                    'goalsAgainstAverage' => $this->goalsAgainstAverage()
                ],
                'teams' => [
                    'gamesPlayed' => $this->team('games_played'),
                    'points' => ($this->team('wins') * 2) + $this->team('overtime_losses')
                ]
            ],
            'skaters' => PlayersResource::collection(
                $this->player->whereIn('position', ['C', 'R', 'L', 'D'])
            ),
            'goalies' => PlayersResource::collection(
                $this->player->whereIn('position', ['G'])
            ),
            'teams' => PlayersResource::collection(
                $this->player->whereIn('position', ['T'])
            ),
            'draft' => $this->pick
        ];
    }

    private function skater($stat)
    {
        return $this->player->where('lineup.dress', 1)->whereIn('position', ['C', 'R', 'L', 'D'])->sum('statsWeek.' . $stat);
    }

    private function goalie($stat)
    {
        return $this->player->where('lineup.dress', 1)->whereIn('position', ['G'])->sum('statsWeek.' . $stat);
    }

    private function team($stat)
    {
        return $this->player->where('lineup.dress', 1)->whereIn('position', ['T'])->sum('statsWeek.' . $stat);
    }

    private function goalsAgainstAverage() {
        if ($this->goalie('time_on_ice') != 0) {
            return number_format(
                round(
                    ($this->goalie('goals_against') * 3600) / $this->goalie('time_on_ice')
                , 2)
            , 2);
        }

        return 0;
    }

    private function savePercentage() {
        if ($this->goalie('saves') != 0) {
            return ltrim(
                number_format(
                    round(
                        $this->goalie('saves') / ($this->goalie('saves') + $this->goalie('goals_against'))
                    , 3)
                , 3)
            , '0');
        }

        return 0;
    }
}
