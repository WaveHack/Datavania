<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Character extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'base_str' => 'int',
        'base_con' => 'int',
        'base_int' => 'int',
        'base_mnd' => 'int',
        'base_lck' => 'int',
    ];

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
        ];
    }
}
