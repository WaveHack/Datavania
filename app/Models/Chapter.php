<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Chapter extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'chapter' => 'int',
        'chests_blue' => 'int',
        'chests_red' => 'int',
        'chests_brown' => 'int',
        'chests_green' => 'int',
        'chests_purple' => 'int',
    ];

    public function bossMusic()
    {
        return $this->belongsTo(Music::class);
    }

    public function boss2Music()
    {
        return $this->belongsTo(Music::class);
    }

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }

    public function hiddenItem()
    {
        return $this->belongsTo(Item::class);
    }

    public function stageMusic()
    {
        return $this->belongsTo(Music::class);
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'chapter' => $this->chapter,
        ];
    }
}
