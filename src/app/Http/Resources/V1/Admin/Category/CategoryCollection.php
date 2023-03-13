<?php

namespace App\Http\Resources\V1\Admin\Category;

use App\Http\Resources\CommonCollection;

class CategoryCollection extends CommonCollection
{
    public $collects = CategoryResource::class;
}
