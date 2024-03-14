<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationsResource extends JsonResource
{
    public bool $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'language' => $this->language,
            'title' => $this->title ?? '',
        ];
    }
}
