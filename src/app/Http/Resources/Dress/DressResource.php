<?php

namespace App\Http\Resources\Dress;

use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Color\ColorResource;
use App\Http\Resources\Photo\PhotoResource;
use App\Http\Resources\Size\SizeResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */

    public function toArray($request): array
    {
        return [
            'dress_id' => $this->dress_id,
            'title' => $this->title,
            'description' => $this->description,
            'deleted' => $this->softDeletes,

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

            $this->mergeWhen(
                $this->relationLoaded('booking'),
                ['booking' => BookingResource::collection($this->whenLoaded('booking'))]
            ),
        ];
    }
}
