<?php

namespace App\Http\Controllers\V1\Client\Rent\Catalog;

use App\Http\Requests\V1\Client\Rent\Catalog\ListDressCatalogRequest;
use App\Http\Resources\V1\Client\Rent\Catalog\ListDressCatalogCollection;
use App\Models\V1\Dress;

class ListDressCatalogController
{
    /**
     * @param ListDressCatalogRequest $request
     * @return ListDressCatalogCollection
     */
    public function list(ListDressCatalogRequest $request): ListDressCatalogCollection
    {
        $requestData = $request->validated();

        $dress = Dress
            ::select()
            ->when($requestData['category_id'] ?? null, function ($q) use ($requestData) {
                $q->whereHas('category', function ($q) use ($requestData) {
                    $q->where('category.category_id', $requestData['category_id']);
                });
            })
//            ->when($requestData['color_id'] ?? null, function ($q) use ($requestData) {
//                $q->whereHas('color', function ($q) use ($requestData) {
//                    $q->where('color.color_id', $requestData['color_id']);
//                });
//            })
//            ->when($requestData['size_id'] ?? null, function ($q) use ($requestData) {
//                $q->whereHas('size', function ($q) use ($requestData) {
//                    $q->where('size.size_id', $requestData['size_id']);
//                });
//            })
//            ->when($requestData['user_id'] ?? null, function ($q) use ($requestData) {
//                $q->where('user_id', $requestData['user_id']);
//            })
            ->with('category.translation:category_id,title')
            ->with('translation:dress_id,title')
            ->with('color.translation')
            ->with('size:size_id,size')
            ->with('photo')
            ->orderBy('dress_id', 'desc')
            ->paginate(
                perPage: $requestData['per_page'] ?? 10,
                page: $requestData['page'] ?? 1
            );

        return new ListDressCatalogCollection($dress);
    }
}
