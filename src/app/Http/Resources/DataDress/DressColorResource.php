<?php

namespace App\Http\Resources\DataDress;

use Illuminate\Http\Resources\Json\JsonResource;

class DressColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'dress_color_id' =>$this->dress_color_id,
            'dress_id' => $this->dress_id,
            'color_id' => $this->color_id,
        ];
    }
}
