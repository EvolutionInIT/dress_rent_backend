<?php

namespace App\Http\Requests\Language;

use App\Http\Requests\CommonRequest;

class LanguageRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language' => 'required|max:2|min:2',
        ];
    }
}
