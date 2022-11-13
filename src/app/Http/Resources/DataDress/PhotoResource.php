<?php

namespace App\Http\Resources\DataDress;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'photo_id' => $this->photo_id,
            'image' => $this->image,
            'image_small' => $this->image_small
        ];
    }
}
