<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    protected $table = 'scouts';

    public $timestamps = false;

    protected $hidden = ['player_id'];

    public function toArray()
    {
        return [
            'scout' => $this->{auth()->id()}
        ];
    }
}
