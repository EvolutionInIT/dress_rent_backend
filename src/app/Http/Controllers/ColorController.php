<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\DataDress\SaveColorRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ColorController extends Controller
{
    public function save(SaveColorRequest $request)
    {
        $requestData = $request->validated();

        $color = Color::create([
            'color_id' => $requestData['color_id'],
            'color' => $requestData['color'],
        ]);

        if ($color)
            return response()->json(['data' => $color->toArray()], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'color_save_error'], ResponseAlias::HTTP_BAD_GATEWAY);
    }
}
