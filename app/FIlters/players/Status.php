<?php

namespace App\Filters\players;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Status extends FilterAbstract
{
    /**
     * Mappings for database values.
     *
     * @return array
     */
    public function mappings()
    {
        return [
            'fa' => [9],
            'roster' => [1,2,3,4,5,6,7,8],
            'all' => [1,2,3,4,5,6,7,8,9]
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

        return $builder->whereIn('franchise_id', $value);
    }
}
