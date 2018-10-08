<?php

namespace App\Repositories\LimitRepository;

use Exception;

/**
 *
 */

class Show
{
    public function count($request)
    {
        $a = array_column($request, 'lineup');
        $x = 0;

        foreach ($a as $b) {
            if ($b['dress'] === 1 || $b['bench']) { $x = $x + 1; }
        }

        if ($x > 26) {
            throw new Exception("error");
        }
    }
}