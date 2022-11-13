<?php


namespace App\Http\Requests\User;

use App\Http\Requests\CommonRequest;

class SaveUserRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|min:4|max:100',
            'email' => 'required',
            'email_verified_at' => 'required',
            'password' => 'required'
        ];

        return $rules;
    }
};
