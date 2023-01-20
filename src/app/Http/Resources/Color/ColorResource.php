<?php

namespace App\Http\Resources\Color;

use App\Http\Resources\Dress\DressResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */

    //public $preserveKeys = true;

    public function toArray($request): array
    {
        return [
            'color_id' => $this->color_id,
            'color' => $this->color,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->whenLoaded('dress'))]
            ),
        ];
    }
}
