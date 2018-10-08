<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'gameCount' => $this->gameCount(),
            '1' => $this->schedule(1),
            '2' => $this->schedule(2),
            '3' => $this->schedule(3),
            '4' => $this->schedule(4),
            '5' => $this->schedule(5),
            '6' => $this->schedule(6),
            '7' => $this->schedule(7)
        ];
    }

    private function schedule($day)
    {
        return $this->where('day', '=', $day)->first()->opponent;
    }

    private function gameCount()
    {
        $days = [1, 2, 3, 4, 5, 6, 7];
        $x = 0;

        foreach ($days as $day) {
            if ($this->schedule($day) != null) {
                $x++;
            }
        }

        return $x;
    }
}
