<?php


namespace App\Http\Requests\Booking;

use App\Http\Requests\CommonRequest;

class ListBookingRequest extends CommonRequest
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
