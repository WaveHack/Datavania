<?php

use App\Models\Chapter;

class ChapterSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return Chapter::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/chapters.json');
    }
}
