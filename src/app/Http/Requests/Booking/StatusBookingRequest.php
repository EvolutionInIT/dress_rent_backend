<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\CommonRequest;

class StatusBookingRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dress_id' => [
                //'required',
                'array'
            ],
            'dress_id.*' => [
                //'required',
                'integer',
                'distinct',
                'between:1,4294967296',
                'exists:App\Models\Dress,dress_id',
            ]
        ];
    }
}
