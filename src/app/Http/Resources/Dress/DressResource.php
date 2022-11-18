<?php

namespace App\Http\Resources\Dress;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\DataDress\ColorResource;
use App\Http\Resources\DataDress\PhotoResource;
use App\Http\Resources\DataDress\SizeResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DressResource extends JsonResource
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
            'dress_id' => $this->dress_id,
            'title' => $this->title,
            'description' => $this->description,

            $this->mergeWhen(
                $this->relationLoaded('user'),
                ['user' => new UserResource($this->whenLoaded('user'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('category'),
                ['category' => CategoryResource::collection($this->whenLoaded('category'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('color'),
                ['color' => ColorResource::collection($this->whenLoaded('color'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('size'),
                ['size' => SizeResource::collection($this->whenLoaded('size'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('photo'),
                ['photo' => PhotoResource::collection($this->whenLoaded('photo'))]
            ),
        ];
    }
}
