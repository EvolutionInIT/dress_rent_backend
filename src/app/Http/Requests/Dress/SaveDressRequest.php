<?php


namespace App\Http\Requests\Dress;

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
            'title' => 'present|min:1|max:100',
            'description' => 'present|min:0|max:5000',
            'user_id' => 'required|integer|exists:App\Models\User,user_id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:App\Models\Category,category_id',
            'color_id' => 'required|array',
            'color_id.*' => 'required|integer|exists:App\Models\Color,color_id',
            'size_id' => 'required|array',
            'size_id.*' => 'required|integer|exists:App\Models\Size,size_id',
            'photo' => 'array',
            'photo.*' => 'image:png,jpeg,jpg|min:5|max:5000',

        ];
    }
}



