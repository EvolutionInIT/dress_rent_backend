<?php


namespace App\Http\Requests\V1\Admin\Category;

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


