<?php

namespace App\Http\Resources\trades;

use Illuminate\Http\Resources\Json\JsonResource;

class PickResource extends JsonResource
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
            'ownerId' => $this->owner_id,
            'franchiseId' => $this->franchise_id,
            'draftRound' => $this->round
        ];
    }
}
