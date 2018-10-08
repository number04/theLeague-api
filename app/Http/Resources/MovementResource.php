<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Player;

class MovementResource extends JsonResource
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
            'playerName' => $this->value('first_name') . ' ' . $this->value('last_name'),
            'playerAbbv' => substr($this->value('first_name'), 0, 1) . '. ' . $this->value('last_name'),
            'position' => $this->value('position'),
            'nhl' => substr($this->value('nhl'), -3, 3),
            'type' => $this->type,
            'timestamp' => $this->timestamp
        ];
    }

    private function value($value)
    {
        return Player::where('id', $this->player_id)->pluck($value)->first();
    }
}
