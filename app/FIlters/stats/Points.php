<?php

namespace App\Filters\stats;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use DB;

class Points extends FilterAbstract
{
    /**
     * Filter by subject.
     *
     * @param  string $subject
     * @return Illuminate\Database\Eloquent\Builder
     */
     public function filter(Builder $builder, $direction)
    {
        return $builder->orderBy(DB::raw('goals + assists'), $this->resolveOrderDirection($direction));
    }
}
