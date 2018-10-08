<?php

namespace App\Filters\players;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class NHL extends FilterAbstract
{
    /**
     * Mappings for database values.
     *
     * @return array
     */
    public function mappings()
    {
        return [
            'ANA' => 'ANA',
            'ARI' => 'ARI',
            'BOS' => 'BOS',
            'BUF' => 'BUF',
            'CAR' => 'CAR',
            'CBJ' => 'CBJ',
            'CGY' => 'CGY',
            'CHI' => 'CHI',
            'COL' => 'COL',
            'DAL' => 'DAL',
            'DET' => 'DET',
            'EDM' => 'EDM',
            'FLA' => 'FLA',
            'LAK' => 'LAK',
            'MIN' => 'MIN',
            'MTL' => 'MTL',
            'NJD' => 'NJD',
            'NSH' => 'NSH',
            'NYI' => 'NYI',
            'NYR' => 'NYR',
            'OTT' => 'OTT',
            'PHI' => 'PHI',
            'PIT' => 'PIT',
            'SJS' => 'SJS',
            'STL' => 'STL',
            'TBL' => 'TBL',
            'TOR' => 'TOR',
            'VAN' => 'VAN',
            'VGK' => 'VGK',
            'WPG' => 'WPG',
            'WSH' => 'WSH',
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

        return $builder->where('nhl', 'like', '%' . $value);
    }
}
