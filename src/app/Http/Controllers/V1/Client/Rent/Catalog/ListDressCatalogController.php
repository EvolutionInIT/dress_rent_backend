<?php

namespace App\Http\Controllers\V1\Client\Rent\Catalog;

use App\Http\Requests\V1\Client\Rent\Catalog\ListDressCatalogRequest;
use App\Http\Resources\V1\Client\Rent\Catalog\ListDressCatalogCollection;
use App\Http\Services\V1\Admin\DressCatalogAdminService;

class ListDressCatalogController
{
    /**
     * @param ListDressCatalogRequest $request
     * @return ListDressCatalogCollection
     */
    public function list(ListDressCatalogRequest $request): ListDressCatalogCollection
    {
        $requestData = $request->validated();
        $dresses =  DressCatalogAdminService::get(requestData: $requestData, method: 'list', withPrice: true, orderField: 'order');
        return new ListDressCatalogCollection($dresses);
    }
}
