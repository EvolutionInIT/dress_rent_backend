<?php

namespace App\Http\Requests\V1\Client\Rent\Booking;

use App\Http\Requests\CommonRequest;
use App\Models\V1\Booking;
use Carbon\Carbon;

class SaveBookingRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $weeksTwo = Carbon::now()->addWeeks(2);
        return [
            'date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->toDateString() .
                'before_or_equal:' . $weeksTwo->toDateString()
            ],
            'dress_id' => [
                'bail',
                'required',
                'integer',
                'between:1,4294967296',
                'exists:App\Models\V1\Dress,dress_id',
                function ($attribute, $value, $fail) {

                    $date = $this->input('date');
                    $bookingDress =
                        Booking
                            ::where('date', $date)
                            ->where('dress_id', $value)
                            ->with('dress:dress_id,quantity')
                            ->get();

                    //dd($bookingDress->toArray());

                    if (count($bookingDress) && count($bookingDress) >= $bookingDress[0]->quantity)
                        $fail("booking_save_dress_quantity_less_then_needed");
                },
            ],
        ];
    }

}
