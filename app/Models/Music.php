<?php

namespace App\Models;

class Music extends AbstractModel
{
    protected $table = 'music';

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }
}
