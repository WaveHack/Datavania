<?php

use App\Models\Music;

class MusicSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return Music::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/music.json');
    }
}
