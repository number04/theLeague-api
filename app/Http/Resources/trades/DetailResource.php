<?php

namespace App\Http\Resources\trades;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
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
            'id' => $this->id,
            'isOpen' => $this->open,
            'isAccepted' => $this->accepted,
            'isRejected' => $this->rejected,
            'isWithdrawn' => $this->withdrawn,
            'offeredBy' => $this->offered_by,
            'offeredTo' => $this->offered_to,
            'createdAt' => $this->created_at->format('d M'),
            'updatedAt' => $this->updated_at->format('d M'),
            'players' => PlayerResource::collection($this->player),
            'picks' => PickResource::collection($this->pick)
        ];
    }
}
