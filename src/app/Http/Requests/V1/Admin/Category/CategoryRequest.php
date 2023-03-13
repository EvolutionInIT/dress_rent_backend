<?php

namespace App\Http\Requests\V1\Admin\Category;

use App\Http\Requests\CommonRequest;

class CategoryRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\Category,category_id',
        ];
    }
}
