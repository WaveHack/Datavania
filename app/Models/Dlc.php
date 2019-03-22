<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Dlc extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'msp' => 'int',
    ];

    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function music()
    {
        return $this->hasMany(Music::class);
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
        ];
    }
}
