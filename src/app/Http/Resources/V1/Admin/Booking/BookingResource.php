<?php

namespace App\Http\Resources\V1\Admin\Booking;

use App\Http\Resources\V1\Admin\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            //'booking_id' => $this->booking_id,
            //'date' => $this->date,
            'dress_id' => $this->dress_id,
            'status' => $this->status,
            'title' => $this->title,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->dress)]
            ),

        ];
    }
}
