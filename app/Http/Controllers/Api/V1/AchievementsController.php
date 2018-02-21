<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Achievement;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class AchievementsController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new Achievement);
    }
}
