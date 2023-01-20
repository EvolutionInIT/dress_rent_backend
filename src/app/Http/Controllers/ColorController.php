<?php

namespace App\Http\Controllers;

use App\Http\Requests\Color\ColorRequest;
use App\Http\Requests\Color\DeleteColorRequest;
use App\Http\Requests\Color\ListColorRequest;
use App\Http\Requests\DataDress\SaveColorRequest;
use App\Http\Resources\Color\ColorCollection;
use App\Http\Resources\Color\ColorResource;
use App\Models\Color;

class ColorController extends Controller
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
            ->when($requestData['dress_id'] ?? null, function ($q) use ($requestData) {
                $q->where('dress_id', $requestData['dress_id']);
            })
            ->with('dress:dress_id,title,description')
            ->paginate($requestData['per_page'] ?? 10, $requestData['page'] ?? 1);

        return new ColorCollection($color);
    }

    public function delete(DeleteColorRequest $request): ColorResource
    {
        $requestData = $request->validated();

        $color = Color
            ::where('color_id', $requestData['color_id'])
            ->delete();

        return new ColorResource($color);

    }
}
