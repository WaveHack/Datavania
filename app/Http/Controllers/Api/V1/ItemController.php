<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Spatie\QueryBuilder\QueryBuilder;

class ItemController extends AbstractApiController
{
    public function index()
    {
        $items = QueryBuilder::for(Item::class)
            ->allowedFilters('slug', 'name')
            ->allowedIncludes('dlc', 'item_type')
            ->paginate();

        return new ItemCollection($items);
    }

    public function show(int $id)
    {
        $item = QueryBuilder::for(Item::class)
            ->allowedIncludes('dlc')
            ->with('itemType')
            ->findOrFail($id);

        return new ItemResource($item);
    }
}
