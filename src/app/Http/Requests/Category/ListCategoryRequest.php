<?php


namespace App\Http\Requests\Category;

use App\Http\Requests\CommonRequest;

class ListCategoryRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'category_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Category,category_id',
            'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\User,user_id',
            'color_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Color,color_id',
            'size_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Size,size_id',
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|between:1,100',
        ];
    }
}


