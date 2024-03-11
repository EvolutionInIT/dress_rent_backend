<?php

namespace App\Http\Resources\V1\Admin\Photo;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'photo_id' => $this->photo_id,
            'image' => env('APP_URL') . '/storage/user/2' . '/rent/dress/' . $this->dress_id . '/' . $this->image,
            'image_small' => env('APP_URL') . '/storage/user/2' . '/rent/dress/' . $this->dress_id . '/' . $this->image_small,
        ];
    }
}
