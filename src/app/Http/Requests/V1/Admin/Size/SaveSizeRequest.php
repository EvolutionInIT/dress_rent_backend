<?php

namespace App\Http\Requests\V1\Admin\Size;

use App\Http\Requests\CommonRequest;

class SaveSizeRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'size' => 'required|alpha|min:1|max:3',
        ];
    }
}
