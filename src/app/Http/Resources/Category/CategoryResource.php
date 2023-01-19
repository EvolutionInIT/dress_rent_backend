<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Dress\DressResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */

    public bool $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => DressResource::collection($this->whenLoaded('dress'))]
            ),
        ];
    }
}
