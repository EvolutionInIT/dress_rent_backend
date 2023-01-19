<?php

namespace App\Http\Resources\DataDress;

use Illuminate\Http\Resources\Json\JsonResource;

class DressPhotoResource extends JsonResource
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
            'dress_photo_id' =>$this->dress_photo_id,
            'dress_id' => $this->dress_id,
            'photo_id' => $this->photo_id,
//            'photo_size' => $this->photo_size,


            $this->mergeWhen(
                $this->photo_size,
                ['photo_size'=>$this->photo_size],
            ),

            $this->mergeWhen(
                $this->relationLoaded('photo_size'),
                ['photo_size' => PhotoSizeResource::collection($this->whenLoaded('photo_size'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('photo'),
                ['photo' => DressPhotoSizeResource::collection($this->whenLoaded('photo'))]
            ),
        ];
    }
}
