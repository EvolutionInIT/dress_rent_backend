<?php

namespace App\Http\Controllers\V1\Client\Rent\Booking;

use App\Http\Requests\V1\Client\Rent\Booking\AvailableBookingRequest;
use App\Http\Resources\V1\Client\Rent\Booking\AvailableBookingResource;
use App\Models\V1\Dress;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use stdClass;

class AvailableBookingClientRentController
{
    /**
     * @param AvailableBookingRequest $request
     * @return AnonymousResourceCollection
     */
    public function available(AvailableBookingRequest $request): AnonymousResourceCollection
    {
        $requestData = $request->validated();

        $dates = [];
        for (
            $date = Carbon::now();
            $date->lte(Carbon::now()->addWeeks(2));
            $date->addDay()
        ) {
            $dates[] = $date->toDateString();
        }

        $dresses =
            Dress
                ::select(['dress_id', 'quantity'])
                ->where('dress.dress_id', $requestData['dress_id'])
                ->get();

        $status =
            Dress
//                ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                    $q->whereIn('dress.dress_id', $requestData['dress_id']);
//                })
                ::where('dress.dress_id', $requestData['dress_id'])
                //->with(['dress' => function ($q) {
                //$q
                ->join('booking', function ($join) {
                    $join->on('dress.dress_id', '=', 'booking.dress_id')
                        ->where('booking.date', '>=', Carbon::now()->toDateString())
                        ->where('booking.date', '<=', Carbon::now()->addWeeks(2)->toDateString());
                })
                ->select(['dress.dress_id', 'booking.date', DB::raw('SUM(booking.quantity) as booked')])
                ->groupBy(['dress.dress_id', 'booking.date'])
                //->havingRaw('dress.quantity > booked OR booked IS NULL')
                ->orderBy('dress.dress_id')
                //;
                //}])

                ->get();

        //dd($status->toArray());

        $datesStatus = [];

        foreach ($dates as $date) {

            $dayBookings = $status->where('date', $date)->values();

            $arr = [];
            foreach ($dresses as $dress) {

                $tmp = new stdClass();
                $tmp->dress_id = $dress->dress_id;
//                $tmp->quantity = $dress->quantity;
//                $tmp->booked = 0;
                $tmp->free = $dress->quantity;

                if (count($dayBookings)) {
                    $dayDressBooking = $dayBookings->where('dress_id', $dress->dress_id)->values();
                    if (count($dayDressBooking) === 1) {
//                        $tmp->booked = $dayDressBooking[0]->booked;
                        $tmp->free = $dress->quantity - ($dayDressBooking[0]->booked ?? 0);
                    }
                }

                $arr[] = $tmp;
            }


            $datesStatus[] = [
                'date' => $date,
                'booking' => $arr
            ];
        }

        //dd($datesStatus);
        return AvailableBookingResource::collection($datesStatus);
    }
}
