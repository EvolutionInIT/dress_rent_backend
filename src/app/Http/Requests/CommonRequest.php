<?php

namespace App\Http\Requests;

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

    public function messages()
    {
        return [
            'required' => 'validation_field_required',
            'regex' => 'validation_field_regex_invalid',
            'file' => 'validation_field_must_be_a_file',
            'between' => 'validation_field_between_from_:min_to_:max',
            'exists' => 'validation_field_not_found',
            'email' => 'validation_field_must_be_email',
            'max' => 'validation_field_max_:max',
            'min' => 'validation_field_min_:min',
            'unique' => 'validation_field_must_be_unique',
            'numeric' => 'validation_field_must_be_numeric',
            'integer' => 'validation_field_must_be_integer',
            'uuid' => 'validation_field_uuid_invalid',
            'url' => 'validation_field_url_invalid',
            'array' => 'validation_field_must_be_array',
            'string' => 'validation_field_must_be_string',
            //'mimes' => 'validation_field_file_must_be_format_:attribute',
            'mimes' => 'validation_field_mimes_invalid',
            'required_with' => 'validation_field_required_with',
            'required_without' => 'validation_field_required_without',
            'after' => 'validation_field_date_after',
            'after_or_equal' => 'validation_field_date_after_or_equal',
            'before' => 'validation_field_date_before_:date',
            'before_or_equal' => 'validation_field_date_before_or_equal',
            'date_format' => 'validation_field_date_format_invalid_:format',
            'date' => 'validation_field_date_invalid',
            'alpha_dash' => 'validation_field_alpha_dash_invalid',
            'image' => 'validation_field_image_invalid',
            'size' => 'validation_filed_size_:size',
            'digits' => 'validation_filed_digits',
            'digits_between' => 'validation_filed_size_:min_:max',
            'present' => 'validation_field_present',
            'filled' => 'validation_field_required',
        ];
    }
}
