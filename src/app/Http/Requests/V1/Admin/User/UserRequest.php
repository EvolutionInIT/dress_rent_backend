<?php

namespace App\Http\Requests\V1\Admin\User;

use App\Http\Requests\CommonRequest;

class UserRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\V1\User\User,user_id'
        ];
    }
}
