<?php


namespace App\Http\Requests\DressCategory;

use App\Http\Requests\CommonRequest;

class SaveDressCategoryRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'dress_id' => 'required|integer|exists:App\Models\Category,category_id',
            'category_id' => 'required|integer|exists:App\Models\Category,category_id',
        ];

        return $rules;
    }
};
