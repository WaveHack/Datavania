<?php

namespace App\Models;

class Character extends AbstractModel
{
    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }
}
