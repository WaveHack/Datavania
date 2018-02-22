<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'item_type' => ItemTypeResource::make($this->whenLoaded('itemType')),
            'name' => $this->name,
            'description' => $this->description,
            'rarity' => $this->rarity,
            'is_starter' => $this->is_starter,
            'is_shoppable' => $this->is_shoppable,
            'value' => $this->value,
            'stats' => [
                'atk' => $this->stat_atk,
                // todo
            ],
            'resistances' => [
                // todo
            ],
            'attribute1' => $this->attribute1,
            'attribute2' => $this->attribute2,
            'is_consumable' => $this->is_consumable,
            'is_consumed_over_time' => $this->is_consumed_over_time,
            'dlc' => DlcResource::make($this->whenLoaded('dlc')),
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
