<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\CommonRequest;
use App\Models\Booking;
use App\Models\Dress;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
                'required',
                'integer',
                'between:1,4294967296',
                'exists:App\Models\Dress,dress_id',
//                function ($attribute, $value, $fail) {
//
//                    $date = $this->input('date');
//                    $bookingDress =
//                        Booking
//                            ::where('date', $date)
//                            ->where('dress_id', $value)
//                            ->with('dress:dress_id,quantity')
//                            ->get();
//
//                    //dd($bookingDress->toArray());
//
//                    if (count($bookingDress) && count($bookingDress) >= $bookingDress[0]->quantity)
//                        $fail("dress_save_dress_quantity_enought");
//                },
                function ($attribute, $value, $fail) {
                    //$date = $this->input('date');
                    $date = date('Y-m-d', strtotime($this->input('date')));
                    $dress =
                        Dress
                            ::leftJoin('booking', function ($join) use ($date) {
                                $join->on('dress.dress_id', '=', 'booking.dress_id')
                                    ->where('booking.date', '>=', $date)
                                    ->where('booking.date', '<=', DB::raw('DATE_ADD(CURDATE(), INTERVAL 2 WEEK)'));
                            })
                            ->withCount(['booking' => function ($query) use ($date) {
                                $query->where('date', '>=', $date);
                            }])
//                            ->when('booking_count', '<', 'quantity', function ($q) use ($fail) {
//                                $q->$fail("dress_save_dress_quantity_enought");
//                            })
                            ->find($value);

                    if ($dress->quantity <= $dress->booking_count) {
                        $fail("dress_save_dress_quantity_enought");
                    }
                },
            ],
        ];
    }

}
