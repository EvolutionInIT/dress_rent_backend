<?php


namespace App\Http\Requests\User;

use App\Http\Requests\CommonRequest;

class SaveUserRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:4|max:100',
            'email' => 'required',
            'password' => 'required'
        ];
    }
}

;
