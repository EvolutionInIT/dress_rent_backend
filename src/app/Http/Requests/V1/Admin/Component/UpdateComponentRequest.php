<?php

namespace App\Http\Requests\V1\Admin\Component;

class UpdateComponentRequest extends SaveComponentRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'component_id' => 'required|integer|between:1,4294967296|exists:App\Models\V1\Component,component_id',
            ...parent::rules()
        ];
    }
}
