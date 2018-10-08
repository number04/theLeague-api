<?php

namespace App\Filters\players;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Scout extends FilterAbstract
{
    /**
     * Filter by subject.
     *
     * @param  string $subject
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('scout', function (Builder $builder) use ($value) {
            $builder->where(auth()->id(), $value);
        });
    }
}
