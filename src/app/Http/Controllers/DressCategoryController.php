<?php

namespace App\Http\Controllers;

use App\Http\Requests\DressCategory\SaveDressCategoryRequest;
use App\Models\DressCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DressCategoryController {
    /**
     * @param SaveDressCategoryRequest $request
     * @return JsonResponse
     */
    public function save(SaveDressCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $requestData = $request->validated();

        $dress_category = DressCategory::create([
            'dress_id' => $requestData['dress_id'],
            'category_id' => $requestData['category_id'],
        ]);

        if ($dress_category)
            return response()->json(['date' => $dress_category->toArray()], Response::HTTP_OK);
        else
            return response()->json(['error' => 'dress_category_save_error'], Response::HTTP_BAD_GATEWAY);
    }
}


