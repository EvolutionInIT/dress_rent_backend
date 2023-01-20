<?php


namespace App\Http\Requests\Color;

use App\Http\Requests\CommonRequest;

class ListColorRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'color_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Color,color_id',
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|between:1,100',
        ];
    }
}


