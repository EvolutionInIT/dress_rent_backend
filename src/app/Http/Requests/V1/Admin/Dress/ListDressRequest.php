<?php


namespace App\Http\Requests\V1\Admin\Dress;

use App\Http\Requests\CommonRequest;

class ListDressRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\Category,category_id',
            //'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\User,user_id',
            'color_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\Color,color_id',
            'size_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\Size,size_id',
            ...$this->paginationRules()
        ];
    }
}
