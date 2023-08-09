<?php

namespace App\Http\Controllers\V1\Client\Rent\Catalog;

use App\Http\Requests\V1\Client\Rent\Catalog\DressCatalogRequest;
use App\Http\Resources\V1\Client\Rent\Catalog\DressCatalogResource;
use App\Models\V1\Dress;

class DressCatalogController
{
    /**
     * @param DressCatalogRequest $request
     * @return DressCatalogResource
     */
    public function dress(DressCatalogRequest $request): DressCatalogResource
    {
        $requestData = $request->validated();

        $dress = Dress
            ::select()
            ->where('dress_id', $requestData['dress_id'])
            ->with('translation')
            ->with('category.translation')
            ->with('photo')
            ->with('size')
            ->with('color.translation')
            ->first();

        return new DressCatalogResource($dress);
    }
}
