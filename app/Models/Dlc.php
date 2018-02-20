<?php

namespace App\Models;

class Dlc extends AbstractModel
{
    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
