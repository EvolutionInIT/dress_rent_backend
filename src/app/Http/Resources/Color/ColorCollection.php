<?php

namespace App\Http\Resources\Color;

use App\Http\Resources\CommonCollection;

class ColorCollection extends CommonCollection
{
    public $collects = ColorResource::class;
}
