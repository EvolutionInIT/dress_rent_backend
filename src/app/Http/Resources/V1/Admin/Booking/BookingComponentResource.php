<?php

namespace App\Http\Resources\V1\Admin\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingComponentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'component_id' => $this->component_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'title' => $this->translation->title ?? '',
            'date' => $request->date,
        ];
    }
}
