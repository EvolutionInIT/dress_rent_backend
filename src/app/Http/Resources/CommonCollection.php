<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommonCollection extends ResourceCollection
{

    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'page' => $resource->currentPage(),
            'per_page' => $resource->perPage(),
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }


    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'pagination' => $this->pagination,
        ];
    }

}
