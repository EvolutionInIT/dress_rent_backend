<?php


namespace App\Http\Requests\V1\Admin\Dress;

use App\Http\Requests\CommonRequest;

class SaveDressRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //'title' => 'present|min:1|max:100',
            //'description' => 'present|min:0|max:5000',
            'user_id' => 'required|integer|exists:App\Models\V1\User\User,user_id',
            'quantity' => 'required|integer',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:App\Models\V1\Category,category_id',
            'color_id' => 'required|array',
            'color_id.*' => 'required|integer|exists:App\Models\V1\Color,color_id',
            'size_id' => 'required|array',
            'size_id.*' => 'required|integer|exists:App\Models\V1\Size,size_id',
            'photo' => 'array',
            'photo.*' => 'image:png,jpeg,jpg|min:5|max:5000',

        ];
    }
}



