<?php


namespace App\Http\Requests\Category;

use App\Http\Requests\CommonRequest;

class DeleteCategoryRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Category,category_id',
        ];
    }
}
