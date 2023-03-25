<?php

namespace App\Http\Requests\V1\Client\Rent\Booking;

use App\Http\Requests\CommonRequest;

class AvailableBookingRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dress_id' =>
                [
                    'required', 'integer', 'between:1,4294967296',
                    'exists:App\Models\V1\Dress,dress_id',
                ]
        ];
    }
}
