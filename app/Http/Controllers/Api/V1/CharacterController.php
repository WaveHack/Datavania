<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use Spatie\QueryBuilder\QueryBuilder;

class CharacterController extends AbstractApiController
{
    public function index()
    {
        $characters = QueryBuilder::for(Character::class)
            ->allowedFilters('slug', 'code', 'name')
            ->allowedIncludes('dlc')
            ->paginate();

        return new CharacterCollection(CharacterResource::collection($characters));
    }

    public function show(int $id)
    {
        $character = QueryBuilder::for(Character::class)
            ->allowedIncludes('dlc')
            ->findOrFail($id);

        return new CharacterResource($character);
    }
}
