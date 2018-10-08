<?php

namespace App\Repositories\LimitRepository;

use Exception;

/**
 *
 */

class Health
{
    public function count($request)
    {
        $a = array_column($request, 'isInjured', 'playerName');
        $b = array_column($request, 'lineup', 'playerName');
        $c = array_merge_recursive($a, $b);

        foreach ($c as $d) {
            if ($d[0] != 'inj' && $d['injury'] === 1) {

                throw new Exception("error");
            }
        }
    }
}