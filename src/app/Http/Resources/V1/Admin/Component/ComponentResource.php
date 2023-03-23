<?php

namespace App\Http\Resources\V1\Admin\Component;

use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'component_id' => $this->component_id,
            'quantity' => $this->quantity,
            'price' => $this->price,

            $this->mergeWhen(
                $this->relationLoaded('translation'),
                [
                    'title' => $this->translation->title ?? '',
                    'description' => $this->translation->description ?? '',
                ]
            ),

            $this->mergeWhen(
                $this->relationLoaded('translations'),
                ['translations' => ComponentTranslationResource::collection($this->whenLoaded('translations'))]
            )
        ];
    }
}
