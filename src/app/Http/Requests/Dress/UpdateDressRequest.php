<?php

namespace App\Http\Requests\Dress;

class UpdateDressRequest extends SaveDressRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dress_id' => 'required|integer|between:1,4294967296|exists:App\Models\Dress,dress_id',
            ...parent::rules()
        ];
    }
}
