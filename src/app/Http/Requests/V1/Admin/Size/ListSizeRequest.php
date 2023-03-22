<?php


namespace App\Http\Requests\V1\Admin\Size;

use App\Http\Requests\CommonRequest;

class ListSizeRequest extends CommonRequest
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


