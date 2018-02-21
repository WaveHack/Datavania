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
        $music = QueryBuilder::for(Music::class)
            ->allowedFilters('slug', 'name')
            ->allowedIncludes('dlc')
            ->paginate();

        return new MusicCollection($music);
    }

    public function show(int $id)
    {
        $music = QueryBuilder::for(Music::class)
            ->allowedIncludes('dlc')
            ->findOrFail($id);

        return new MusicResource($music);
    }
}
