<?php


namespace App\Http\Requests\V1\Admin\User;

use App\Http\Requests\CommonRequest;

class ListUserRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->paginationRules();
    }
}


