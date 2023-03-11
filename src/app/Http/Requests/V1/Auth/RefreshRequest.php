<?php

namespace App\Http\Requests\V1\Auth;

class RefreshRequest extends CommonRequest
{

    /**
     * @inheritDoc
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        $rules = [
            'refresh_token' => 'required|alpha_num|size:32',
        ];

        return $rules;
    }

}
