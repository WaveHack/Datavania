<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\AchievementCollection;
use App\Http\Resources\AchievementResource;
use App\Models\Achievement;
use Spatie\QueryBuilder\QueryBuilder;

class AchievementController extends AbstractApiController
{
    public function index()
    {
        $achievements = QueryBuilder::for(Achievement::class)
            ->allowedFilters('slug', 'name')
            ->get();

        return new AchievementCollection($achievements);
    }

    public function show(Achievement $achievement)
    {
        return new AchievementResource($achievement);
    }
}
