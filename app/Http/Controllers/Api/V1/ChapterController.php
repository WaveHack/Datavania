<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\ChapterCollection;
use App\Http\Resources\ChapterResource;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Models\Chapter;
use App\Models\Character;
use Spatie\QueryBuilder\QueryBuilder;

class ChapterController extends AbstractApiController
{
    public function index()
    {
        $chapters = QueryBuilder::for(Chapter::class)
            ->allowedFilters('slug', 'chapter', 'name')
            ->allowedIncludes('hidden_item', 'stage_music', 'boss_music', 'boss2_music', 'dlc')
            ->paginate();

        return new ChapterCollection($chapters);
    }

    public function show(int $id)
    {
        $chapter = QueryBuilder::for(Chapter::class)
            ->allowedIncludes('hidden_item', 'stage_music', 'boss_music', 'boss2_music', 'dlc')
            ->findOrFail($id);

        return new ChapterResource($chapter);
    }
}
