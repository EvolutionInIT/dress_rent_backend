<?php

namespace App\Http\Requests\V1\Admin\Dress;

use App\Http\Requests\CommonRequest;

class DressRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //@TODO change to check dress owner
        return [
            'dress_id' => 'required|integer|between:1,4294967296|exists:App\Models\V1\Dress,dress_id',
        ];
    }
}
