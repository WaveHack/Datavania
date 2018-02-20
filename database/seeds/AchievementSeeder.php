<?php

use App\Models\Achievement;

class AchievementSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return Achievement::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/achievements.json');
    }
}
