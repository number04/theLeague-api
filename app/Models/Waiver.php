<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Waiver extends Model
{
    protected $table = 'waivers';

    public $timestamps = false;

    public function scopeOffWaivers($query)
    {
        return $query->where('created_at', '<=', Carbon::now()->subDays(2)->toDateTimeString());
    }
}
