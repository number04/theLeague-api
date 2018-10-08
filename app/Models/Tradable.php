<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tradable extends Model
{
    protected $table = 'tradables';

    protected $fillable = [
        'tradable_id', 'tradable_type',
    ];

    public $timestamps = false;
}
