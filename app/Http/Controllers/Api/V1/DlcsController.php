<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Dlc;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class DlcsController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new Dlc);
    }
}
