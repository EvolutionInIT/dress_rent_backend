<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\ListCategoryRequest;
use App\Http\Requests\Category\SaveCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController
{
    public function get(ListCategoryRequest $request): JsonResponse
    {
        $categoryID = $request->validated()['category_id'] ?? null;

        $category = Category
            ::when($categoryID, function ($q) use ($categoryID) {
                $q->where('category_id', $categoryID);
            })
            ->get();

        if ($category)
            return response()->json(['data' => $category->toArray()], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'category_get_error'], ResponseAlias::HTTP_BAD_GATEWAY);
    }

    /**
     * @param SaveCategoryRequest $request
     * @return JsonResponse
     */
    public function save(SaveCategoryRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        $category = Category::create([
            'title' => $requestData['title'],
            'description' => $requestData['description'],
        ]);

        if ($category)
            return response()->json(['date' => $category->toArray()], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'category_save_error'], ResponseAlias::HTTP_BAD_GATEWAY);

    }


    public function list(ListCategoryRequest $request): CategoryCollection
    {
        $requestData = $request->validated();
        $page = $requestData['page'] ?? 1;
        $perPage = $requestData['per_page'] ?? 10;
        $dressID = $requestData['dress_id'] ?? null;

        $category = Category
            ::select()
            ->when($dressID, function ($q) use ($dressID) {
                $q->where('dress_id', $dressID);
            })
            ->with('dress:dress_id,title,description')
            ->paginate($perPage, $page);

        return new CategoryCollection($category);
    }


    public function delete(ListCategoryRequest $request): JsonResponse
    {
        $categoryID = $request->validated()['category_id'];

        $category = Category
            ::where('category_id', $categoryID)
            ->delete();

        if ($category)
            return response()->json(['message' => 'deleted'], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'catefory_delete_error'], ResponseAlias::HTTP_BAD_GATEWAY);
    }
}


