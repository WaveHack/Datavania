<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AchievementCollection extends ResourceCollection
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return AchievementResource::collection($this->collection);
    }
}
