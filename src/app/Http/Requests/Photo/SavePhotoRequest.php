<?php

namespace App\Http\Requests\Photo;

use App\Http\Requests\CommonRequest;

class SavePhotoRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => 'array',
            'photo.*' => 'image:png,jpeg,jpg|min:5|max:5000',
        ];
    }
}
