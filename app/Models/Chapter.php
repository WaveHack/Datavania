<?php

namespace App\Models;

class Chapter extends AbstractModel
{
    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }
}
