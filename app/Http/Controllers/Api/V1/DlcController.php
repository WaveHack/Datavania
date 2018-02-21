<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\DlcCollection;
use App\Http\Resources\DlcResource;
use App\Models\Dlc;
use Spatie\QueryBuilder\QueryBuilder;

class DlcController extends AbstractApiController
{
    public function index()
    {
        $dlcs = QueryBuilder::for(Dlc::class)
            ->allowedFilters('slug', 'name', 'type')
            ->paginate();

        return new DlcCollection($dlcs);
    }

    public function show(Dlc $dlc)
    {
        return new DlcResource($dlc);
    }
}
