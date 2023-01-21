<?php


namespace App\Http\Requests\Color;

use App\Http\Requests\CommonRequest;

class ListColorRequest extends CommonRequest
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


