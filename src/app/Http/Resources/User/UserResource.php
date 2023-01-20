<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Dress\DressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'email' => $this->email,

            $this->mergeWhen(
                $this->relationLoaded('dress'),
                ['dress' => new DressResource($this->whenLoaded('dress'))]
            ),
        ];
    }
}
