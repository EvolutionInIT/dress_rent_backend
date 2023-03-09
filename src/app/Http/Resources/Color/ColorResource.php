<?php

namespace App\Http\Resources\Color;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'color_id' => $this->color_id,

            $this->mergeWhen(
                $this->relationLoaded('translation'),
                [
                    'color' => $this->translation->color ?? '',
                ]
            )
        ];
    }
}
