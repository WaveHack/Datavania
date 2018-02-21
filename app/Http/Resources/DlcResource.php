<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DlcResource extends JsonResource
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'msp' => $this->msp,
            'release_date' => $this->release_date,
            'size' => $this->size,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
