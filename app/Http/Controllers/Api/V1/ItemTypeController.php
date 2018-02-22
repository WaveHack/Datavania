<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\ItemTypeCollection;
use App\Http\Resources\ItemTypeResource;
use App\Models\ItemType;
use Spatie\QueryBuilder\QueryBuilder;

class ItemTypeController extends AbstractApiController
{
    public function index()
    {
        $itemTypes = QueryBuilder::for(ItemType::class)
            ->allowedFilters('slug', 'name')
            ->paginate();

        return new ItemTypeCollection($itemTypes);
    }

    public function show(int $id)
    {
        $itemType = QueryBuilder::for(ItemType::class)
            // todo: allowed include: items
            ->findOrFail($id);

        return new ItemTypeResource($itemType);
    }
}
