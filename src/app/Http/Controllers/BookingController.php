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
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingController
{
    public function list(ListBookingRequest $request): BookingCollection
    {
        $requestData = $request->validated();

        $booking = Booking
            ::select()
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new BookingCollection($booking);
    }


    public function save(SaveBookingRequest $request): array|BookingResource
    {
        $requestData = $request->validated();

        $booking = Booking::firstOrCreate($requestData, ['status' => Booking::STATUSES['NEW']]);

        return new BookingResource($booking);
    }


    public function cancel(CancelBookingRequest $request): BookingResource|JsonResponse
    {
        $requestData = $request->validated();

        $booking = Booking
            ::where('dress_id', $requestData['dress_id'])
            ->where('date', $requestData['date'])
            ->first();

        if ($booking) {
            $booking->status = Booking::STATUSES['CANCELED'];
            $booking->save();
            return new BookingResource($booking);
        } else
            return response()->json(['message' => 'Booking not found'], 404);
    }


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

        $datesStatus = [];
        $status = Booking::whereIn('dress_id', $requestData['dress_id'])
            ->whereNotIn('status', ['canceled'])
            ->whereIn('date', $dates)
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
