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
            'quantity' => 'required|integer|between:1,255',
            //@TODO load currencies
            'prices' => 'present|array|required_array_keys:KZT,RUB,USD',
            'prices.*' => 'required|integer|between:0,4294967296',
            'categories' => 'required|array',
            'categories.*' => 'required|integer|exists:App\Models\V1\Category,category_id',
            'colors' => 'required|array',
            'colors.*' => 'required|integer|exists:App\Models\V1\Color,color_id',
            'sizes' => 'required|array',
            'sizes.*' => 'required|integer|exists:App\Models\V1\Size,size_id',
            'width_big' => 'sometimes|integer|min:500|max:1500',
            'width_small' => 'sometimes|integer|min:100|max:500',
            'photos' => 'sometimes|array',
            'photos.*' => 'image:png,jpeg,jpg|min:5|max:1500',
            //@TODO load translations
            'translations' => 'present|array|required_array_keys:en,ru,kk',
            'translations.*' => 'sometimes|array:title,description',
            'translations.*.title' => 'present|filled|min:1|max:255',
            'translations.*.description' => 'present|filled|min:1|max:5000',
        ];
    }
}



