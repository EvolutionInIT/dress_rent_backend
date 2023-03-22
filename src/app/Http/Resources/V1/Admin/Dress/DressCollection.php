<?php

namespace App\Http\Resources\V1\Admin\Dress;

use App\Http\Resources\CommonCollection;

class DressCollection extends CommonCollection
{
    public $collects = DressResource::class;
}
