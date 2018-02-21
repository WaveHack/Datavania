<?php

namespace App\Models;

class Chapter extends AbstractModel
{
    public function bossMusic()
    {
        return $this->belongsTo(Music::class);
    }

    public function boss2Music()
    {
        return $this->belongsTo(Music::class);
    }

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }

    public function hiddenItem()
    {
        return $this->belongsTo(Item::class);
    }

    public function stageMusic()
    {
        return $this->belongsTo(Music::class);
    }
}
