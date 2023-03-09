<?php

namespace App\Http\Controllers;

use App\Http\Requests\Color\ColorRequest;
use App\Http\Requests\Color\DeleteColorRequest;
use App\Http\Requests\Color\ListColorRequest;
use App\Http\Requests\Color\SaveColorRequest;
use App\Http\Resources\Color\ColorCollection;
use App\Http\Resources\Color\ColorResource;
use App\Models\Color;
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

        $color = Color::create([
            'color' => $requestData['color'],
        ]);

        return new ColorResource($color);
    }

    public function list(ListColorRequest $request): ColorCollection
    {
        $requestData = $request->validated();

        $color = Color
            ::select()
            ->with('translation:color_id,color')
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new ColorCollection($color);
    }

    public function delete(DeleteColorRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Color::where('color_id', $requestData['color_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], ResponseAlias::HTTP_OK);

    }
}
