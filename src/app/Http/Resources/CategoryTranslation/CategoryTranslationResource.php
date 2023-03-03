<?php

namespace App\Http\Resources\CategoryTranslation;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTranslationResource extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'category_id' => $this->category_id,
            'category_translation_id' => $this->category_translation_id,
            'language' => $this->language,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
