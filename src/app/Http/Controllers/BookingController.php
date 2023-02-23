<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CancelBookingRequest;
use App\Http\Requests\Booking\ListBookingRequest;
use App\Http\Requests\Booking\SaveBookingRequest;
use App\Http\Requests\Booking\StatusBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingDateResource;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class BookingController
{
    /**
     * @param ListBookingRequest $request
     * @return BookingCollection
     */
    public function list(ListBookingRequest $request): BookingCollection
    {
        $requestData = $request->validated();

        $booking =
            Booking
                ::select()
                ->paginate(
                    perPage: $requestData['per_page'] ?? 10,
                    page: $requestData['page'] ?? 1
                );

        return new BookingCollection($booking);
    }


    /**
     * @param SaveBookingRequest $request
     * @return BookingResource
     */
    public function save(SaveBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();

        $requestData['status'] = Booking::STATUSES['NEW'];
        $booking = Booking::create($requestData);

        return new BookingResource($booking);
    }


    /**
     * @param CancelBookingRequest $request
     * @return BookingResource
     */
    public function cancel(CancelBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();

        $booking = Booking
            ::where('dress_id', $requestData['dress_id'])
            ->where('date', $requestData['date'])
            ->first();

        $booking->status = Booking::STATUSES['CANCELED'];
        $booking->save();
        return new BookingResource($booking);
    }


    /**
     * @param StatusBookingRequest $request
     * @return AnonymousResourceCollection
     */
    public function status(StatusBookingRequest $request): AnonymousResourceCollection
    {
        $requestData = $request->validated();

        $dates = [];
        for (
            $date = Carbon::now();
            $date->lte(Carbon::now()->addWeeks(2));
            $date->addDay()
        )
            $dates[] = $date->toDateString();

        $datesStatus = [];

        $status = Booking
            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
                $q->whereIn('dress_id', $requestData['dress_id']);
            })
            ->whereIn('date', $dates)
            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
            ->select('booking_id', 'dress_id', 'date', 'status', DB::raw('COUNT(*) as booking_count'))
            ->with(['dress' => function ($q) {
                $q->select('dress_id', 'quantity');
            }])
            ->groupBy('booking_id', 'dress_id', 'date', 'status')
            ->havingRaw('booking_count < (SELECT quantity FROM dress
                            WHERE dress.dress_id = booking.dress_id AND quantity >
                            (SELECT COUNT(*) FROM booking WHERE booking.dress_id = dress.dress_id AND date BETWEEN ? AND ?))'
                , [Carbon::today(), Carbon::today()->addDays(14)])
            ->get();

        foreach ($dates as &$date) {
            $datesStatus[] = [
                'date' => $date,
                'booking' => $status->where('date', $date)
            ];
        }

        return BookingDateResource::collection($datesStatus);
    }

}
