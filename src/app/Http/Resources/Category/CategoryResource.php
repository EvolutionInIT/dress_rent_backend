<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
