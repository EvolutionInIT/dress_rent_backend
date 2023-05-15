<?php

namespace App\Http\Resources\V1\Client\Rent\Catalog;

use App\Http\Resources\V1\Client\Price\PriceResource;
use App\Http\Resources\Size\SizeResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\V1\Admin\Color\ColorResource;
use App\Http\Resources\V1\Admin\Photo\PhotoResource;
use App\Http\Resources\V1\Client\Category\CategoryResourceClient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DressCatalogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */


    public function toArray(Request $request): array
    {

        return [
            'dress_id' => $this->dress_id,

            $this->mergeWhen(
                $this->relationLoaded('translation'),
                [
                    'title' => $this->translation->title ?? '',
                    'description' => $this->translation->description ?? '',
                ]
            ),

            $this->mergeWhen(
                $this->relationLoaded('price'),
                [
                    'price' => $this->price->price ?? '',
                ]
            ),

            $this->mergeWhen(
                isset($this->quantity),
                ['quantity' => $this->quantity]
            ),

            $this->mergeWhen(
                isset($this->deleted),
                ['deleted' => $this->deleted]
            ),

            $this->mergeWhen(
                $this->relationLoaded('user'),
                ['user' => new UserResource($this->whenLoaded('user'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('category'),
                ['category' => CategoryResourceClient::collection($this->whenLoaded('category'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('color'),
                ['color' => ColorResource::collection($this->whenLoaded('color'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('size'),
                ['size' => SizeResource::collection($this->whenLoaded('size'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('photo'),
                ['photo' => PhotoResource::collection($this->whenLoaded('photo'))]
            ),

        ];
    }
}
