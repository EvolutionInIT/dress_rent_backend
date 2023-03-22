<?php

namespace App\Http\Requests\V1\Admin\Color;

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
            'color_id' => 'required|integer|between:1,4294967296|exists:App\Models\V1\Color,color_id',
        ];
    }
}
