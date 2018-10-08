<?php

namespace App\Repositories\LimitRepository;

use Exception;

/**
 *
 */

class Injury
{
    public function count($request)
    {
        $a = array_column($request, 'lineup');
        $x = 0;

        foreach ($a as $b) {
            if ($b['injury'] === 1) { $x = $x + 1; }
        }

        if ($x > 2) {
            throw new Exception("error");
        }
    }
}