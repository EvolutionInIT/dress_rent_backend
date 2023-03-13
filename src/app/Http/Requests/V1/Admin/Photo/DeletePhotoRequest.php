<?php

namespace App\Http\Requests\V1\Admin\Photo;

use App\Http\Requests\CommonRequest;

class DeletePhotoRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\Photo,photo_id',
        ];
    }
}
