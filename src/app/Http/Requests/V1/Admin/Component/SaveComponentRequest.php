<?php

namespace App\Http\Requests\V1\Admin\Component;

use App\Http\Requests\CommonRequest;

class SaveComponentRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required|integer',
            'price' => 'required|integer',

            'translations' => 'sometimes|array',
            'translations.*.title' => 'present|min:0|max:255',
            'translations.*.description' => 'present|min:0|max:255',
            'translations.*.language' => 'required|string',
        ];
    }
}
