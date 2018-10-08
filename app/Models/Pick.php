<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
    protected $table = 'picks';

    public $timestamps = false;

    protected $hidden = ['owner_id'];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    // public function trade()
    // {
    //     return $this->morphToMany(Trade::class, 'tradable');
    // }
}
