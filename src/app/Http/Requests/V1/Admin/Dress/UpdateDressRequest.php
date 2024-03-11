<?php

namespace App\Http\Requests\V1\Admin\Dress;

class UpdateDressRequest extends SaveDressRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //@TODO owner dress_id
            'dress_id' => 'required|integer|between:1,4294967296|exists:App\Models\V1\Dress,dress_id',
            ...parent::rules()
        ];
    }
}
