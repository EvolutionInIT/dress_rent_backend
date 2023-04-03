<?php

namespace App\Http\Resources\V2\Client\Rent\Booking;

use App\Http\Resources\V1\Admin\Color\ColorResource;
use App\Http\Resources\V1\Admin\Size\SizeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingColorSizeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'booking_color_size_id' => $this->booking_color_size_id,

            $this->mergeWhen(
                $this->relationLoaded('color'),
                ['color' => new ColorResource($this->color)]
            ),

            $this->mergeWhen(
                $this->relationLoaded('size'),
                ['size' => new SizeResource($this->size)]
            ),
        ];
    }
}
