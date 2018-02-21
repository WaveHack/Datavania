<?php

namespace App\JsonApi\Achievements;

use App\Models\Achievement;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends EloquentAdapter
{
//    protected $defaultPagination = [
//        'number' => 1,
//    ];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Achievement, $paging);
    }

    /**
     * {@inheritdoc}
     */
    protected function filter(Builder $query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }

    /**
     * {@inheritdoc}
     */
    protected function isSearchOne(Collection $filters)
    {
        // TODO: Implement isSearchOne() method.
    }
}
