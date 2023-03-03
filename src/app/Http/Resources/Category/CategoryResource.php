<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\CategoryTranslation\CategoryTranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {

        $title = $this->title;
        $description = $this->description;
        if ($this->relationLoaded('translation') && $translation = $this->translation->firstWhere('language', $request->language)) {
            $title = $translation->title;
            $description = $translation->description;
        }

        return [
            'category_id' => $this->category_id,
            'title' => $title,
            'description' => $description,
        ];
    }
}
