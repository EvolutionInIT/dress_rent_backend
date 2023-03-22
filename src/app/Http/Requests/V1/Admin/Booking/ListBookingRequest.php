<?php


namespace App\Http\Requests\V1\Admin\Booking;

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
