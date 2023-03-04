<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {

        $title = $this->title;
        $description = $this->description;
        if ($this->relationLoaded('translations') && $translation = $this->translations->firstWhere('language', $request->language)) {
            $title = $translation->title;
            $description = $translation->description;
        }

        return [
            'category_id' => $this->category_id,
            'language' => $this->language, // Возможно не будет нужен, добавлен для теста
            'title' => $title,
            'description' => $description,
        ];
    }
}
