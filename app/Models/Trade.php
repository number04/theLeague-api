<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $table = 'trades';

    protected $dates = ['created_at', 'updated_at'];

    public function player()
    {
        return $this->morphedByMany(Player::class, 'tradable');
    }

    public function pick()
    {
        return $this->morphedByMany(Pick::class, 'tradable');
    }
}
