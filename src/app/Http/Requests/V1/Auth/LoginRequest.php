<?php


namespace App\Http\Requests\V1\Auth;

use App\Http\Requests\CommonRequest;

class LoginRequest extends CommonRequest {

    /**
     * @inheritDoc
     */
    public function authorize() {

        return true;
    }

    /**
     * @inheritDoc
     */
    public function rules() {

        $rules = [
            'email' => 'required|email:rfc,spoof,filter|min:1|max:40',
            'password' => 'required|string|min:1|max:50',
        ];

        return $rules;
    }

}
