<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Music extends AbstractModel
{
    use Searchable;

    protected $table = 'music';

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }

    public function searchableAs()
    {
        return 'search';
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'type' => 'Music',
            'typeSlug' => 'music',
            'iconClass' => 'sprite sprite-music',
        ];
    }
}
