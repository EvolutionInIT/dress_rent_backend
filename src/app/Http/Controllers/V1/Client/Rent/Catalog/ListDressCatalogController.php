<?php

namespace App\Http\Controllers\V1\Client\Rent\Catalog;

use App\Http\Requests\V1\Client\Rent\Catalog\ListDressCatalogRequest;
use App\Http\Resources\V1\Client\Rent\Catalog\ListDressCatalogCollection;
use App\Http\Services\V1\Client\DressCatalogClientService;

class ListDressCatalogController
{
    /**
     * @param ListDressCatalogRequest $request
     * @return ListDressCatalogCollection
     */
    public function list(ListDressCatalogRequest $request): ListDressCatalogCollection
    {
        $requestData = $request->validated();
        $dresses =  DressCatalogClientService::get(requestData: $requestData, method: 'list');
        return new ListDressCatalogCollection($dresses);
    }
}
