<?php

namespace App\Http\Controllers\V1\Client\Rent\Category;

use App\Http\Requests\V1\Client\Rent\Category\ListCategoryRequest;
use App\Http\Resources\V1\Client\Category\CategoryResourceClient;
use App\Models\V1\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryClientRentController
{
    /**
     * @param ListCategoryRequest $requestData
     * @return AnonymousResourceCollection
     */
    public function list(ListCategoryRequest $requestData): AnonymousResourceCollection
    {
        $requestData = $requestData->validated();
        $categories =
            Category
                ::select(['category_id', 'dress_id'])
                ->with('translation:category_id,title,description')
                ->when($requestData['with_translations'] ?? false, function ($q) {
                    $q->with('translations');
                })
                ->with('photos')
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


