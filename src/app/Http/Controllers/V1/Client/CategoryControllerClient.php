<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Resources\V1\Client\Category\CategoryResourceClient;
use App\Models\V1\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryControllerClient
{
    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        $category =
            Category
                ::with('translation:category_id,title')
                ->get();

        return CategoryResourceClient::collection($category);
    }
}


