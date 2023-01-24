<?php

namespace App\Http\Requests\Booking;

class CancelBookingRequest extends SaveBookingRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            ...parent::rules()
        ];
    }
}
