<?php

namespace App\Http\Resources\V1\Admin\Component;

use Illuminate\Http\Resources\Json\JsonResource;

class ComponentTranslationResource extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'language' => $this->language,
            'title' => $this->title ?? '',
            'description' => $this->description ?? '',
        ];
    }
}
