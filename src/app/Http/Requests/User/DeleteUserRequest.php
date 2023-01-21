<?php

namespace App\Http\Requests\User;

use App\Http\Requests\CommonRequest;

class DeleteUserRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
        ];
    }
}
