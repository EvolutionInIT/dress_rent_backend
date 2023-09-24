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

            'user_id' => 'required|integer|exists:App\Models\V1\User\User,user_id',
            'quantity' => 'required|integer',
            'category_id' => 'sometimes|array',
            'category_id.*' => 'required|integer|exists:App\Models\V1\Category,category_id',
            'color_id' => 'sometimes|array',
            'color_id.*' => 'required|integer|exists:App\Models\V1\Color,color_id',
            'size_id' => 'sometimes|array',
            'size_id.*' => 'required|integer|exists:App\Models\V1\Size,size_id',
            'photo' => 'array',
            'photo.*' => 'image:png,jpeg,jpg|min:5|max:5000',

            'width' => 'sometimes|array',
            'width.*' => 'integer|min:100|max:1200',

            'translations' => 'sometimes|array',
            'translations.*.title' => 'present|min:0|max:255',
            'translations.*.description' => 'present|min:0|max:255',
            'translations.*.language' => 'required|string',

        ];
    }
}



