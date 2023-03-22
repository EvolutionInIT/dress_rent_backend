<?php

namespace App\Http\Resources\V1\Client\Rent\Catalog;

use App\Http\Resources\CommonCollection;

class ListDressCatalogCollection extends CommonCollection
{
    public $collects = DressCatalogResource::class;
}
