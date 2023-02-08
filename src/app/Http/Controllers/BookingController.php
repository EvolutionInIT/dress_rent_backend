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
use App\Models\Dress;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * @return BookingResource|JsonResponse
     */
    public function save(SaveBookingRequest $request): BookingResource|JsonResponse
    {
        $requestData = $request->validated();

        $dress =
            Dress
                ::where('dress_id', $requestData['dress_id'])
                ->first();

        if ($dress->quantity <= $dress->booking()->count())
            return response()->json(['error' => 'Dress not available for booking'], 400);

        $booking =
            Booking
                ::create($requestData, ['status' => Booking::STATUSES['NEW']]);

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
        ) {
            $dates[] = $date->toDateString();
        }

        $dress = Dress
            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
                $q->whereIn('dress_id', $requestData['dress_id']);
            })
            ->withCount('booking')
            ->get()
            ->filter(function ($dress) {
                return $dress->booking_count < $dress->quantity;
            })->values();

        $dressFilter = [];
        foreach ($dress as $dr) {
            $dressFilter [] = [
                'dress_id' => $dr->dress_id
            ];
        }

        $datesStatus = [];
        $status = Booking
            ::whereIn('dress_id', $dressFilter)
            ->whereIn('date', $dates)
            ->with('dress:dress_id,title,quantity')
            ->get();

        foreach ($dates as $date) {

            $datesStatus[] = [
                'date' => $date,
                'booking' => $status->where('date', $date)
            ];
        }

        return BookingDateResource::collection($datesStatus);

    }

}
