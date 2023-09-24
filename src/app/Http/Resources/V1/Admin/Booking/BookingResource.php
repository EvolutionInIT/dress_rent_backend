<?php

namespace App\Http\Resources\V1\Admin\Booking;

use App\Http\Resources\V1\Admin\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'booking_id' => $this->booking_id,
            'dress_id' => $this->dress_id,
            'date' => $this->date,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'quantity' => $this->quantity,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->dress)]
            ),

        ];
    }
}
