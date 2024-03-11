<?php

namespace App\Http\Resources\V1\Admin\Dress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DressCurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            $this->mergeWhen(
                isset($this->pivot->price),
                ['price' => $this->pivot->price]
            ),

            'currency_id' => $this->currency_id,
            'code' => $this->code,
            'symbol' => $this->symbol,

            $this->mergeWhen(
                $this->relationLoaded('translation'),
                [
                    'title' => $this->translation->title ?? '',
                ]
            )
        ];
    }
}
