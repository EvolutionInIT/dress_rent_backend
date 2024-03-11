<?php

namespace App\Http\Controllers\V1\Client\Rent\Catalog;

use App\Http\Requests\V1\Client\Rent\Catalog\DressCatalogRequest;
use App\Http\Resources\V1\Client\Rent\Catalog\DressCatalogResource;
use App\Http\Services\V1\Admin\DressCatalogAdminService;

class DressCatalogController
{
    /**
     * @param DressCatalogRequest $request
     * @return DressCatalogResource
     */
    public function dress(DressCatalogRequest $request): DressCatalogResource
    {
        $requestData = $request->validated();
        $dress = DressCatalogAdminService::get(requestData: $requestData, method: 'first', withPrice: true);
        return new DressCatalogResource($dress);
    }
}
