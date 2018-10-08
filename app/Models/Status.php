<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public $timestamps = false;

    public function toArray()
    {
        return [
            'status' => [
                'matchupDate' => Week::find($this->value + 1)->date,
                'day' => $this->value('day'),
                'week' => $this->value('week'),
                'openWeek' => $this->value('open_week'),
                'date' => Week::find($this->value('week'))->date,
                'openDate' => Week::find($this->value('open_week'))->date,
                'matchup' => $this->value('matchup'),
                'playoff' => $this->value('playoff')
            ],

            'weeks' => Week::all()
        ];
    }

    public function value($value)
    {
        return Status::where('name', $value)->pluck('value')->first();
    }
}
