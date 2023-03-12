<?php

namespace App\Http\Resources\V1\Client\Language;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'language_id' => $this->language_id,
            'title' => $this->title,
            'code' => $this->code,
        ];
    }
}
