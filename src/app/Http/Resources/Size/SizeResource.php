<?php

namespace App\Http\Resources\Size;

use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'size_id' => $this->size_id,
            'size' => $this->size,
        ];
    }
}
