<?php

namespace App\Http\Resources\Photo;

use App\Http\Resources\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'photo_id' => $this->photo_id,
            //'dress_id' => $this->dress_id,
            'image' => $this->image,
            'image_small' => $this->image_small,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->whenLoaded('dress'))]
            ),
        ];
    }
}
