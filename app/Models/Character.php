<?php

namespace App\Models;

class Character extends AbstractModel
{
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
}
