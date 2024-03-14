<?php

namespace App\Http\Resources\V1\Client\Rent\Catalog;

use App\Http\Resources\V1\Admin\Color\ColorResource;
use App\Http\Resources\V1\Admin\Photo\PhotoResource;
use App\Http\Resources\V1\Admin\Size\SizeResource;
use App\Http\Resources\V1\Client\Category\CategoryResourceClient;
use App\Http\Resources\V1\Client\Rent\User\UserResource;
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
                    'price' => $this->price->price ?? 0,
                ]
            ),

            $this->mergeWhen(
                isset($this->quantity),
                ['quantity' => $this->quantity]
            ),

            $this->mergeWhen(
                isset($this->period),
                ['period' => $this->period]
            ),

            $this->mergeWhen(
                isset($this->wide),
                ['wide' => $this->wide]
            ),


            $this->mergeWhen(
                isset($this->deleted),
                ['deleted' => $this->deleted_at]
            ),

            $this->mergeWhen(
                $this->relationLoaded('user'),
                ['user' => new UserResource($this->whenLoaded('user'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('categories'),
                ['categories' => CategoryResourceClient::collection($this->whenLoaded('categories'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('colors'),
                ['colors' => ColorResource::collection($this->whenLoaded('colors'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('sizes'),
                ['sizes' => SizeResource::collection($this->whenLoaded('sizes'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('photos'),
                ['photos' => PhotoResource::collection($this->whenLoaded('photos'))]
            ),

            'updated_at' => $this->updated_at,

        ];
    }
}
