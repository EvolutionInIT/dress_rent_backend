<?php


namespace App\Http\Requests\DataDress;

use App\Http\Requests\CommonRequest;

class SaveColorRequest extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'color_id' => '',
            'color' => '',
        ];

        return $rules;
    }
};

