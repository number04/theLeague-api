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
        return [
            'franchiseId' => $this->id,
            'franchiseName' => $this->franchise_name,
            'franchiseTag' => $this->franchise_tag,
            'cap' => $this->cap_hit,
            'needs' => $this->need,
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
}
