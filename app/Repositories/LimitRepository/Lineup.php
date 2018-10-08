<?php

namespace App\Repositories\LimitRepository;

use Exception;

/**
 *
 */

class Lineup
{
    public function count($request)
    {
        $a = array_column($request, 'position', 'playerName');
        $b = array_column($request, 'lineup', 'playerName');
        $c = array_merge_recursive($a, $b);

        $center = 0;
        $left = 0;
        $right = 0;
        $defense = 0;
        $goalie = 0;
        $team = 0;

        foreach ($c as $d) {
            if ($d[0] === 'C' && $d['dress'] === 1) { $center = $center + 1; }

            if ($d[0] === 'L' && $d['dress'] === 1) { $left = $left + 1; }

            if ($d[0] === 'R' && $d['dress'] === 1) { $right = $right + 1; }

            if ($d[0] === 'D' && $d['dress'] === 1) { $defense = $defense + 1; }

            if ($d[0] === 'G' && $d['dress'] === 1) { $goalie = $goalie + 1; }

            if ($d[0] === 'T' && $d['dress'] === 1) { $team = $team + 1; }
        }

        if ($center === 5 && ($left > 4 || $right > 4 || $defense > 4) ||
            $left === 5 && ($center > 4 || $right > 4 || $defense > 4) ||
            $right === 5 && ($left > 4 || $center > 4 || $defense > 4) ||
            $center > 5 ||
            $left > 5 ||
            $right > 5 ||
            $defense > 5 ||
            $goalie > 2 ||
            $team > 2) {
                throw new Exception("error");
            }
    }
}