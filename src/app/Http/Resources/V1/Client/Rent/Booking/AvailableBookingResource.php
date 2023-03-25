<?php

namespace App\Http\Resources\V1\Client\Rent\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailableBookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date' => $this->resource['date'],
            'booking' => $this->resource['booking'] ?? []
        ];
    }
}
