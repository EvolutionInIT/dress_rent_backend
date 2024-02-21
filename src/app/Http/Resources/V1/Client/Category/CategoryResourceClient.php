<?php

namespace App\Http\Resources\V1\Client\Category;

use App\Http\Resources\V1\Client\Rent\Photo\PhotoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResourceClient extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'category_id' => $this->category_id,

            $this->mergeWhen(
                $this->relationLoaded('translation'),
                [
                    'title' => $this->translation->title ?? '',
                    //'description' => $this->translation->description ?? '',
                ]
            ),

            $this->mergeWhen(
                $this->relationLoaded('photos'),
                ['photos' => PhotoResource::collection($this->whenLoaded('photos'))]
            )
        ];
    }
}
