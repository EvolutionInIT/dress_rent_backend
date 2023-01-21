<?php

namespace App\Http\Resources\Color;

use App\Http\Resources\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'color_id' => $this->color_id,
            'color' => $this->color,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->whenLoaded('dress'))]
            ),
        ];
    }
}