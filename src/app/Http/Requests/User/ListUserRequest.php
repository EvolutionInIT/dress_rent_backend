<?php


namespace App\Http\Requests\User;

use App\Http\Requests\CommonRequest;

class ListUserRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'user_id' => 'sometimes|integer|between:1,4294967296|exists:App\Models\User,user_id',
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|between:1,100',
        ];
    }
}


