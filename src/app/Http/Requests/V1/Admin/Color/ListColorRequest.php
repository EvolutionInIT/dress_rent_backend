<?php


namespace App\Http\Requests\V1\Admin\Color;

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


