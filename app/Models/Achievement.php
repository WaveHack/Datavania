<?php

namespace App\Models;

class Achievement extends AbstractModel
{
    protected $casts = [
        'points' => 'int',
    ];
}
