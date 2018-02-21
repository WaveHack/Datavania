<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AchievementCollection;
use App\Http\Resources\AchievementResource;
use App\Models\Achievement;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::paginate();

        return new AchievementCollection($achievements);
    }

    public function show(Achievement $achievement)
    {
        return new AchievementResource($achievement);
    }
}
