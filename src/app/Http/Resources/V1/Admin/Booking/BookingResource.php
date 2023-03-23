<?php

namespace App\Http\Resources\V1\Admin\Booking;

use App\Http\Resources\V1\Admin\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'dress_id' => $this->dress_id,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->dress)]
            ),

        ];
    }
}
