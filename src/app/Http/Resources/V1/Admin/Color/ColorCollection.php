<?php

namespace App\Http\Resources\V1\Admin\Color;

use App\Http\Resources\CommonCollection;

class ColorCollection extends CommonCollection
{
    public $collects = ColorResource::class;
}
