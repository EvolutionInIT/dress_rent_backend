<?php

namespace App\Http\Resources\Size;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SizeCollection extends ResourceCollection
{
    public $collects = SizeResource::class;
}
