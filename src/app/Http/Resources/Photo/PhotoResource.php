<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'photo_id' => $this->photo_id,
            'image' => $this->image,
            'image_small' => $this->image_small,
        ];
    }
}
