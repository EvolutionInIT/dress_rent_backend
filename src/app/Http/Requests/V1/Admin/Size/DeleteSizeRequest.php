<?php

namespace App\Http\Requests\V1\Admin\Size;

use App\Http\Requests\CommonRequest;

class DeleteSizeRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'size_id' => 'required|integer|between:1,4294967296|exists:App\Models\V1\Size,size_id',
        ];
    }
}
