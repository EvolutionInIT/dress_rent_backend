<?php

namespace App\Http\Resources\RelationDress;

use Illuminate\Http\Resources\Json\JsonResource;

class DressPhotoSizeResource extends JsonResource
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
            'dress_photo_size_id' => $this->dress_photo_size_id,
            'photo_id' => $this->photo_id,
            $this->mergeWhen(
                $this->photo_size,
                ['photo_size' => $this->photo_size],
            ),
        ];
    }
}
