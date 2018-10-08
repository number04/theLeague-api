<?php

namespace App\Repositories\LimitRepository;

/**
 *
 */

class Limit
{
    protected $states = [
        Show::class,
        Injury::class,
        Lineup::class,
        Health::class
    ];

    public function count($request)
    {
        foreach ($this->states as $state) {
            app($state)->count($request);
        }
        return false;
    }
}