<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'code' => $this->code,
            'name' => $this->name,
            'base_str' => $this->base_str,
            'base_con' => $this->base_con,
            'base_int' => $this->base_int,
            'base_mnd' => $this->base_mnd,
            'base_lck' => $this->base_lck,
            'dlc' => DlcResource::make($this->whenLoaded('dlc')),
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
