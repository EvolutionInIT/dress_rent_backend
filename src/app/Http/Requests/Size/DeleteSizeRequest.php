<?php

namespace App\Http\Requests\Size;

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
            'size_id' => 'required|integer',
        ];
    }
}
