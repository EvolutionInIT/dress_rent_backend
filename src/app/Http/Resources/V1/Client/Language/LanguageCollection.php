<?php

namespace App\Http\Resources\V1\Client\Language;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LanguageCollection extends ResourceCollection
{
    public $collects = LanguageResource::class;
}
