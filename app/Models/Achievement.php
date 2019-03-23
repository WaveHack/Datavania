<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Achievement extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'points' => 'int',
    ];

    public function searchableAs()
    {
        return 'search';
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'type' => 'Achievement',
            'typeSlug' => 'achievement',
            'iconClass' => 'sprite sprite-achievement',
        ];
    }
}
