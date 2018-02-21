<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChapterCollection extends ResourceCollection
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return ChapterResource::collection($this->collection);
    }
}
