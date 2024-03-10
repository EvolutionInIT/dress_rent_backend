<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Color\ColorRequest;
use App\Http\Requests\V1\Admin\Color\DeleteColorRequest;
use App\Http\Requests\V1\Admin\Color\ListColorRequest;
use App\Http\Requests\V1\Admin\Color\SaveColorRequest;
use App\Http\Resources\V1\Admin\Color\ColorCollection;
use App\Http\Resources\V1\Admin\Color\ColorResource;
use App\Models\V1\Color;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ColorController
{
    public function get(ColorRequest $request): ColorResource
    {
        $requestData = $request->validated();

        $color = Color
            ::when($requestData['color_id'] ?? null, function ($q) use ($requestData) {
                $q->where('color_id', $requestData['color_id']);
            })->first();

        return new ColorResource($color);
    }

    public function save(SaveColorRequest $request): ColorResource
    {
        $requestData = $request->validated();

        $color = Color::create($requestData);

        return new ColorResource($color);
    }

    public function list(/*ListColorRequest $request*/): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //$requestData = $request->validated();

        $color = Color
            ::select()
            ->with('translation:color_id,title')
            ->get();
            //->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return ColorResource::collection($color);
    }

    public function delete(DeleteColorRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Color::where('color_id', $requestData['color_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], ResponseAlias::HTTP_OK);

    }
}
