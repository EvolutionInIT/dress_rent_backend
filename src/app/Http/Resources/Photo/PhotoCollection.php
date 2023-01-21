<?php

namespace App\Http\Resources\Photo;

use App\Http\Resources\CommonCollection;

class PhotoCollection extends CommonCollection
{
    public $collects = PhotoResource::class;
}
