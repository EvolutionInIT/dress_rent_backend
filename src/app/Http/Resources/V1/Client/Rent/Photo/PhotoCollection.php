<?php

namespace App\Http\Resources\V1\Client\Rent\Photo;

use App\Http\Resources\CommonCollection;

class PhotoCollection extends CommonCollection
{
    public $collects = PhotoResource::class;
}
