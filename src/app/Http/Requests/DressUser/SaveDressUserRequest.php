<?php

namespace App\Http\Requests\DressUser;

use App\Http\Requests\CommonRequest;

class SaveDressUserRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'dress_id' => 'required|integer|exists:App\Models\Category,category_id',
            'user_id' => 'required|integer|exists:App\Models\Category,category_id',
        ];

        return $rules;
    }

}
