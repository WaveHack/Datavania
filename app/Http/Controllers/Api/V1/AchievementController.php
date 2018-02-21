<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Models\Achievement;

class AchievementController extends AbstractApiController
{
    public function index()
    {
        return Achievement::all();
    }

    public function show(Achievement $achievement)
    {
        return $achievement;
    }
}
