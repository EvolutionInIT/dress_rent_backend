<?php

namespace App\Http\Controllers;

use App\Http\Requests\Size\DeleteSizeRequest;
use App\Http\Requests\Size\ListSizeRequest;
use App\Http\Requests\Size\SaveSizeRequest;
use App\Http\Requests\Size\SizeRequest;
use App\Http\Resources\Size\SizeCollection;
use App\Http\Resources\Size\SizeResource;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
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


    public function list(ListSizeRequest $request): SizeCollection
    {
        $requestData = $request->validated();

        $size = Size
            ::select()
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new SizeCollection($size);
    }


    public function delete(DeleteSizeRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Size::where('size_id', $requestData['size_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], ResponseAlias::HTTP_OK);
    }
}
















