<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Movement extends Model
{
    protected $table = 'movements';

    protected $hidden = ['id'];

    protected $appends = ['timestamp'];

    public function getTimeStampAttribute()
    {
        return Carbon::parse($this->created_at)->format('j M');
    }
}
