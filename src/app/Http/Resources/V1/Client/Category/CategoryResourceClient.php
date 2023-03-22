<?php

namespace App\Http\Resources\V1\Client\Category;

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
            )
        ];
    }
}
