<?php

namespace App\Http\Requests\Color;

use App\Http\Requests\CommonRequest;

class DeleteColorRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'color_id' => 'required|integer|between:1,4294967296|exists:App\Models\Color,color_id',
        ];
    }
}
