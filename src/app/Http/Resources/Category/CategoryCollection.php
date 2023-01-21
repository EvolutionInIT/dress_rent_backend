<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\CommonCollection;

class CategoryCollection extends CommonCollection
{
    public $collects = CategoryResource::class;
}
