<?php

namespace App\Http\Requests\User;

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
            'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\User,user_id'
        ];
    }
}
