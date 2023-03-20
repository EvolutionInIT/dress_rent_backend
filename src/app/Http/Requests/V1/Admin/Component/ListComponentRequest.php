<?php


namespace App\Http\Requests\V1\Admin\Component;

use App\Http\Requests\CommonRequest;

class ListComponentRequest extends CommonRequest
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


