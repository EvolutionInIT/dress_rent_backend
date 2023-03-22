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
        $dressID = $request->validated()['dress_id'] ?? null;

        $dress = Dress
            ::select()
            ->where('dress_id', $dressID)
            ->with('translation')
            ->with('category')
            ->with('photo')
            ->with('size')
            ->first();

        return new DressCatalogResource($dress);

    }
}
