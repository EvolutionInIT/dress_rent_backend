<?php

namespace App\Http\Resources\V1\Client\Rent\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'phone' => $this->phone,
        ];
    }
}
