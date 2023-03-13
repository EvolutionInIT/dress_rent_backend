<?php


namespace App\Http\Requests\V1\Admin\Photo;

use App\Http\Requests\CommonRequest;

class ListPhotoRequest extends CommonRequest
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
