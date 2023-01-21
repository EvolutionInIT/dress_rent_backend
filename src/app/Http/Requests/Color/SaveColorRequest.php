<?php

namespace App\Http\Requests\Color;

use App\Http\Requests\CommonRequest;

class SaveColorRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'color' => 'required|min:10|max:50',
        ];
    }
}
