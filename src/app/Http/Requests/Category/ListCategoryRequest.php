<?php


namespace App\Http\Requests\Category;

use App\Http\Requests\CommonRequest;

class ListCategoryRequest extends CommonRequest
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


