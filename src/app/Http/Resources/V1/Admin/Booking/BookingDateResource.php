<?php

namespace App\Http\Resources\V1\Admin\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingDateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date' => $this->resource['date'],

            $this->mergeWhen(
                $this->resource['booking'],
                ['booking' => BookingResource::collection($this->resource['booking'])]
            ),

        ];
    }
}
