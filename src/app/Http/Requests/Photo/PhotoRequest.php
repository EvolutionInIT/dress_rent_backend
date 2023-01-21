<?php

namespace App\Http\Requests\Photo;

use App\Http\Requests\CommonRequest;

class PhotoRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\Photo,photo_id',
        ];
    }
}
