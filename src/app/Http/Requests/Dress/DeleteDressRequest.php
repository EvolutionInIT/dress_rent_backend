<?php

namespace App\Http\Requests\Dress;

use App\Http\Requests\CommonRequest;

class DeleteDressRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dress_id' => 'required|integer|between:1,4294967296|exists:App\Models\Dress,dress_id',
        ];
    }
}