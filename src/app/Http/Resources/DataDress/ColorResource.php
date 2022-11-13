<?php

namespace App\Http\Resources\DataDress;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $preserveKeys = true;

    public function toArray($request)
    {
        return [
            'color_id' => $this->color_id,
            'color' => $this->color,
        ];
    }
}
