<?php

namespace App\Http\Requests\V1\Admin\Color;

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
            //'color' => 'required|min:3|max:20',
        ];
    }
}
