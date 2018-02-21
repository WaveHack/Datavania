<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\MusicCollection;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Spatie\QueryBuilder\QueryBuilder;

class MusicController extends AbstractApiController
{
    public function index()
    {
        $characters = QueryBuilder::for(Music::class)
            ->allowedFilters('slug', 'name')
            ->allowedIncludes('dlc')
            ->paginate();

        return new MusicCollection($characters);
    }

    public function show(int $id)
    {
        $character = QueryBuilder::for(Music::class)
            ->allowedIncludes('dlc')
            ->findOrFail($id);

        return new MusicResource($character);
    }
}
