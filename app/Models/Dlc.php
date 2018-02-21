<?php

namespace App\Models;

class Dlc extends AbstractModel
{
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
}
