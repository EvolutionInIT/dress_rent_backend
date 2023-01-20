<?php

namespace App\Http\Resources\Color;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ColorCollection extends ResourceCollection
{
    public $collects = ColorResource::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'pagination' => [
                'page' => $this->resource->currentPage(),
                'per_page' => $this->resource->perPage(),
                'total' => $this->resource->total(),
            ],
        ];
    }
}
