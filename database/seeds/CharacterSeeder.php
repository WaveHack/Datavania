<?php

use App\Models\Character;

class CharacterSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return Character::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/characters.json');
    }
}
