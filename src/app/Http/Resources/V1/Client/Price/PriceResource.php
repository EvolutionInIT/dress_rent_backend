<?php

namespace App\Http\Resources\V1\Client\Price;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'dress_price_id' => $this->dress_price_id,
            'code' => $this->code,
            'price' => $this->price,
        ];
    }
}

