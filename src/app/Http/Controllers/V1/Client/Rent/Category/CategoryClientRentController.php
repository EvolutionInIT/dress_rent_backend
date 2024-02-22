<?php

namespace App\Http\Controllers\V1\Client\Rent\Category;

use App\Http\Resources\V1\Client\Category\CategoryResourceClient;
use App\Models\V1\Category;
use App\Models\V1\Dress;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class CategoryClientRentController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        $categories =
            Category
                ::select(['category_id', 'dress_id'])
                ->with('translation:category_id,title')
                ->with('photos:image')
                ->orderBy('order', 'desc')
                ->get();

        return
            CategoryResourceClient::collection(
                $categories->map(function ($category) {
                    $category->photos = $category->photos->splice(0, 1);
                    return $category;
                })
            );
    }
}


