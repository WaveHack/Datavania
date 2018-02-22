<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return ItemResource::collection($this->collection);
    }
}
