<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MusicCollection extends ResourceCollection
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return MusicResource::collection($this->collection);
    }
}
