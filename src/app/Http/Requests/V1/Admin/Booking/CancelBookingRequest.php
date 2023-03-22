<?php

namespace App\Http\Requests\V1\Admin\Booking;

use App\Http\Requests\CommonRequest;
use Carbon\Carbon;

class CancelBookingRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $weeksTwo = Carbon::now()->addWeeks(2);
        return [
            'dress_id' => [
                'required',
                'integer',
                'between:1,4294967296',
                'exists:App\Models\V1\Dress,dress_id',
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->toDateString() .
                'before_or_equal:' . $weeksTwo->toDateString()
            ]
        ];
    }
}
