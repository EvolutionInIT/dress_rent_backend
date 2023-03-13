<?php

namespace App\Http\Requests\V1\Admin\Category;

use App\Http\Requests\CommonRequest;

class SaveCategoryRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:4|max:100',
            'description' => 'required|min:10|max:500',
        ];
    }
}
