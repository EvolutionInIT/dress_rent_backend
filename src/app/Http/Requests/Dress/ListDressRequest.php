<?php


namespace App\Http\Requests\Dress;

use App\Http\Requests\CommonRequest;

class ListDressRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $rules = [
            'category_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Category,category_id',
            'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\User,user_id',
            'color_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Color,color_id',
            'size_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Size,size_id',
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|between:1,100',
        ];


        return $rules;
    }

    public function attributes()
    {
        return [
            'Category_id' => 'Категория'
        ];
    }

    public function messages()
    {
        return [
            'Category_id.required' => 'Поле идентификатора категории является обязательным'
        ];
    }

}

;
