<?php

namespace App\Http\Resources\V1\Admin\Component;

use App\Http\Resources\CommonCollection;

class ComponentCollection extends CommonCollection
{
    public $collects = ComponentResource::class;
}
