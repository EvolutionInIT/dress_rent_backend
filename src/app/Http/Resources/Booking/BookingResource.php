<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'booking_id' => $this->booking_id,
            'dress_id' => $this->dress_id,
            'date' => $this->date,
            //'status' => $this->status,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->dress)]
            ),

        ];
    }
}
