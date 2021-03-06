<?php

namespace App\Filters\stats;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Losses extends FilterAbstract
{
    /**
     * Filter by subject.
     *
     * @param  string $subject
     * @return Illuminate\Database\Eloquent\Builder
     */
     public function filter(Builder $builder, $direction)
    {
        return $builder->orderBy('losses', $this->resolveOrderDirection($direction));
    }
}
