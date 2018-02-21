<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'chapter' => $this->chapter,
            'name' => $this->name,
            'chests' => [
                'blue' => $this->chests_blue,
                'red' => $this->chests_red,
                'brown' => $this->chests_brown,
                'green' => $this->chests_green,
                'purple' => $this->chests_purple,
            ],
            // todo: hidden item
//            'hidden_item' => ItemResource::make($this->whenLoaded('hiddenItem')),
            'stage_music' => MusicResource::make($this->whenLoaded('stageMusic')),
            'boss_music' => MusicResource::make($this->whenLoaded('bossMusic')),
            'boss2_music' => MusicResource::make($this->whenLoaded('boss2Music')),
            'dlc' => DlcResource::make($this->whenLoaded('dlc')),
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
