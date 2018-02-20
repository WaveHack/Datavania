<?php

use App\Models\ItemType;

class ItemTypeSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return ItemType::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/item-types.json');
    }
}
