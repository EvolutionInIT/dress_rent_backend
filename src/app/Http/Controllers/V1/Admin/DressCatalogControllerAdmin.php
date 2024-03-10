<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Dress\DeleteDressRequest;
use App\Http\Requests\V1\Admin\Dress\DressRequest;
use App\Http\Requests\V1\Admin\Dress\ListDressRequest;
use App\Http\Requests\V1\Admin\Dress\SaveDressRequest;
use App\Http\Requests\V1\Admin\Dress\UpdateDressRequest;
use App\Http\Resources\V1\Admin\Dress\DressCollection;
use App\Http\Resources\V1\Admin\Dress\DressResource;
use App\Http\Services\V1\Client\DressCatalogClientService;
use App\Models\V1\Dress;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DressCatalogControllerAdmin
{
    public function get(DressRequest $request): DressResource
    {
        $requestData = $request->validated();
        $dress = DressCatalogClientService::get($requestData);
        return new DressResource($dress);
    }


    /**
     * @param SaveDressRequest $request
     * @return DressResource
     */
    public function save(SaveDressRequest $request): DressResource
    {
        $requestData = $request->validated();
        $requestData['user_id'] = auth('api')->user()->user_id;

        $dress = DressCatalogClientService::save(Dress::class, $requestData);
        $dress = DressCatalogClientService::get(requestData: ['dress_id' => $dress->dress_id]);

        return new DressResource($dress);
    }


    /**
     * @param UpdateDressRequest $request
     * @return DressResource
     */
    public function update(UpdateDressRequest $request): DressResource
    {
        $requestData = $request->validated();
        $requestData['user_id'] = auth('api')->user()->user_id;
        $dress = DressCatalogClientService::update(Dress::class, $requestData);
        $dress = DressCatalogClientService::get(requestData: ['dress_id' => $dress->dress_id]);

        return new DressResource($dress);
    }


    /**
     * @param ListDressRequest $request
     * @return DressCollection
     */
    public function list(ListDressRequest $request): DressCollection
    {
        $requestData = $request->validated();
        $dresses = DressCatalogClientService::get(requestData: $requestData, method: 'list');
        return new DressCollection($dresses);
    }


    public function delete(DeleteDressRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Dress
            ::where('dress_id', $requestData['dress_id'])
            ->delete();

        return response()->json(['data' => ['message' => 'success']], Response::HTTP_OK);
    }

}




















