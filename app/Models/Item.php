<?php

namespace App\Models;

class Item extends AbstractModel
{
    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }
}
