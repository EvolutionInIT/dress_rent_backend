<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\CommonRequest;

class SaveCategoryRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|min:4|max:100',
            'description' => 'required|min:10|max:500',
        ];
        return $rules;
    }
};
