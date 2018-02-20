<?php

namespace App\Models;

class ItemType extends AbstractModel
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
