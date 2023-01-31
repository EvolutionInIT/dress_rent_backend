<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


abstract class CommonRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST));
    }

    public function paginationRules(): array
    {
        return [
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|between:1,100',
        ];
    }
}
