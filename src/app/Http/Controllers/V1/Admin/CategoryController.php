<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Category\CategoryRequest;
use App\Http\Requests\V1\Admin\Category\DeleteCategoryRequest;
use App\Http\Requests\V1\Admin\Category\ListCategoryRequest;
use App\Http\Requests\V1\Admin\Category\SaveCategoryRequest;
use App\Http\Resources\V1\Admin\Category\CategoryCollection;
use App\Http\Resources\V1\Admin\Category\CategoryResource;
use App\Models\V1\Category;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController
{
    public function get(CategoryRequest $request): CategoryResource
    {
        $requestData = $request->validated();

        $category = Category
            ::when($requestData['category_id'] ?? null, function ($q) use ($requestData) {
                $q->where('category_id', $requestData['category_id']);
            })
            ->first();

        return new CategoryResource($category);
    }


    /**
     * @param SaveCategoryRequest $request
     * @return CategoryResource
     */
    public function save(SaveCategoryRequest $request): CategoryResource
    {
        $requestData = $request->validated();

        $category = Category::create($requestData);

        return new CategoryResource($category);
    }


    /**
     * @param ListCategoryRequest $request
     * @return CategoryCollection
     */
    public function list(ListCategoryRequest $request): CategoryCollection
    {
        $requestData = $request->validated();

        $category =
            Category
                ::select()
                ->with('translation:category_id,title,description')
                ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new CategoryCollection($category);
    }


    public function delete(DeleteCategoryRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Category::where('category_id', $requestData['category_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], Response::HTTP_OK);
    }
}


