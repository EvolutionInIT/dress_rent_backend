<?php

namespace App\Http\Resources\RelationDress;

use Illuminate\Http\Resources\Json\JsonResource;

class DressSizeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'dress_size_id' => $this->dress_size_id,
            'dress_id' => $this->dress_id,
            'color_id' => $this->color_id,
        ];
    }
}
