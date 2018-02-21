<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DlcCollection extends ResourceCollection
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return DlcResource::collection($this->collection);
    }
}
