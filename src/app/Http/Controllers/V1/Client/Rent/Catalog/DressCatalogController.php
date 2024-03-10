<?php

namespace App\Http\Controllers\V1\Client\Rent\Catalog;

use App\Http\Requests\V1\Client\Rent\Catalog\DressCatalogRequest;
use App\Http\Resources\V1\Client\Rent\Catalog\DressCatalogResource;
use App\Http\Services\V1\Client\DressCatalogClientService;
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
        $dress = DressCatalogClientService::get(requestData: $requestData, method: 'first');
        return new DressCatalogResource($dress);
    }
}
