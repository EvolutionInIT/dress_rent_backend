<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\SaveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController
{
    /**
     * @param SaveCategoryRequest $request
     * @return JsonResponse
     */
    public function save(SaveCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $requestData = $request->validated();

        $category = Category::create([
            'title' => $requestData['title'],
            'description' => $requestData['description'],
        ]);

        if ($category)
            return response()->json(['date' => $category->toArray()], Response::HTTP_OK);
        else
            return response()->json(['error' => 'category_save_error'], Response::HTTP_BAD_GATEWAY);

    }
}


