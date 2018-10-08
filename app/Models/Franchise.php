<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $table = 'franchises';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function player()
    {
        return $this->hasMany(Player::class);
    }

    public function standing()
    {
        return $this->hasMany(Standing::class);
    }

    public function need()
    {
        return $this->hasOne(Need::class);
    }

    public function pick()
    {
        return $this->hasMany(Pick::class, 'owner_id', 'id');
    }
}
