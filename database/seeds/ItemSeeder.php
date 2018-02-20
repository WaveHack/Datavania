<?php

use App\Models\Item;

class ItemSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return Item::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/items.json');
    }
}
