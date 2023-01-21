<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\ListCategoryRequest;
use App\Http\Requests\Category\SaveCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

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


    public function save(SaveCategoryRequest $request): CategoryResource
    {
        $requestData = $request->validated();

        $category = Category::create($requestData);

        return new CategoryResource($category);
    }


    public function list(ListCategoryRequest $request): CategoryCollection
    {
        $requestData = $request->validated();

        $category = Category
            ::select()
            ->when($requestData['dress_id'] ?? null, function ($q) use ($requestData) {
                $q->where('dress_id', $requestData['dress_id']);
            })
            ->with('dress:dress_id,title,description')
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new CategoryCollection($category);
    }


    public function delete(DeleteCategoryRequest $request): CategoryResource
    {
        $requestData = $request->validated();

        $category = Category
            ::where('category_id', $requestData['category_id'])
            ->delete();

        return new CategoryResource($category);
    }
}


