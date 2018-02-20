<?php

use App\Models\Dlc;

class DlcSeeder extends AbstractSlugSeeder
{
    protected function getModelClass(): string
    {
        return Dlc::class;
    }

    protected function getJsonDataPath(): string
    {
        return resource_path('data/dlcs.json');
    }
}
