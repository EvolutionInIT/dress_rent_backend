<?php


namespace App\Http\Requests\Color;

use App\Http\Requests\CommonRequest;

class ColorRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'color_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Color,color_id',
        ];
    }
}
