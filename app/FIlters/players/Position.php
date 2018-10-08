<?php

namespace App\Filters\players;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Position extends FilterAbstract
{
    /**
     * Mappings for database values.
     *
     * @return array
     */
    public function mappings()
    {
        return [
            'C' => ['C'],
            'L' => ['L'],
            'R' => ['R'],
            'D' => ['D'],
            'G' => ['G'],
            'S' => ['C','L','R','D']
        ];
    }

    /**
     * Filter by course difficulty.
     *
     * @param  string $access
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if ($value === null) {
            return $builder;
        }

        return $builder->whereIn('position', $value);
    }
}
