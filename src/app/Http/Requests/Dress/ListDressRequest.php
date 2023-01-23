<?php


namespace App\Http\Requests\Dress;

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
            'category_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Category,category_id',
            'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\User,user_id',
            'color_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Color,color_id',
            'size_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Size,size_id',
            ...$this->paginationRules()
        ];
    }
}
