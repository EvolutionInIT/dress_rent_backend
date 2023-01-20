<?php


namespace App\Http\Requests\Size;

use App\Http\Requests\CommonRequest;

class SizeRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'size_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Color,color_id',
        ];
    }
}
