<?php

namespace App\JsonApi\Achievements;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{
    protected $resourceType = 'achievements';

    protected $attributes = [
        'slug',
        'name',
        'description',
        'points',
    ];
}
