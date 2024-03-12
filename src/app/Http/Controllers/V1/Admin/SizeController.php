<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Size\DeleteSizeRequest;
use App\Http\Requests\V1\Admin\Size\ListSizeRequest;
use App\Http\Requests\V1\Admin\Size\SaveSizeRequest;
use App\Http\Requests\V1\Admin\Size\SizeRequest;
use App\Http\Resources\V1\Admin\Size\SizeResource;
use App\Models\V1\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SizeController
{

    public function get(SizeRequest $request): SizeResource
    {
        $requestData = $request->validated();

        $size = Size
            ::when($requestData['size_id'] ?? null, function ($q) use ($requestData) {
                $q->where('size_id', $requestData['size_id']);
            })->first();

        return new SizeResource($size);
    }


    public function save(SaveSizeRequest $request): SizeResource
    {
        $requestData = $request->validated();

        $size = Size::create($requestData);

        return new SizeResource($size);
    }


    /**
     * @param ListSizeRequest $request
     * @return AnonymousResourceCollection
     */
    public function list(ListSizeRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //$requestData = $request->validated();

        $size = Size
            ::select()
            ->get();
            //->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return SizeResource::collection($size);
    }


    public function delete(DeleteSizeRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Size::where('size_id', $requestData['size_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], ResponseAlias::HTTP_OK);
    }
}
















