<?php

namespace App\Http\Resources\V1\Admin\Dress;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\V1\Admin\Color\ColorResource;
use App\Http\Resources\V1\Admin\Component\ComponentResource;
use App\Http\Resources\V1\Admin\Component\ComponentTranslationResource;
use App\Http\Resources\V1\Admin\Photo\PhotoResource;
use App\Http\Resources\V1\Admin\Size\SizeResource;
use App\Http\Resources\V1\Client\Category\CategoryResourceClient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DressResource extends JsonResource
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
                $this->relationLoaded('translations'),
                ['translations' => ComponentTranslationResource::collection($this->whenLoaded('translations'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('translation'),
                [
                    'title' => $this->translation->title ?? '',
                    'description' => $this->translation->description ?? '',
                ]
            ),

            $this->mergeWhen(
                isset($this->price),
                ['price' => $this->price]
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
                $this->relationLoaded('categories'),
                ['categories' => CategoryResourceClient::collection($this->whenLoaded('categories'))]
            ),

            $this->mergeWhen(
                $this->relationLoaded('component'),
                ['component' => ComponentResource::collection($this->whenLoaded('component'))]
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

        ];
    }
}
