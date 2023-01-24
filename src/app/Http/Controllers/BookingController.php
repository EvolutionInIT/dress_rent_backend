<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CancelBookingRequest;
use App\Http\Requests\Booking\ListBookingRequest;
use App\Http\Requests\Booking\SaveBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

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


    public function save(SaveBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();

        $booking = Booking::create([
            'dress_id' => $requestData['dress_id'],
            'date' => $requestData['date'],
            'status' => Booking::NEW_BOOKING,

            'start_date' => $requestData['start_date'],
            'end_date' => $requestData['end_date']
        ]);


        return new BookingResource($booking);
    }

    public function cancel(CancelBookingRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Booking
            ::where('booking_id', $requestData['booking_id'])
            ->update([
                'status' => Booking::CANCELED_BOOKING
            ]);

        return response()->json(['data' => ['message' => 'booking canceled']], Response::HTTP_OK);
    }

    public function status(CancelBookingRequest $request): array
    {
        $requestData = $request->validated();

        $startDate = Carbon::now();
        $endDate = Carbon::now()->addWeeks(2);

        $bookings = Booking::where('dress_id', $requestData['dress_id'])->whereBetween('start_date', [$startDate, $endDate])->get();
        $bookedDates = $bookings->pluck('start_date')->toArray();

        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $dates = [];
        foreach ($dateRange as $date) {
            $dates[] = [
                'dress_id' => $requestData['dress_id'],
                'date' => $date->toDateString(),
                'status' => in_array($date->toDateString(), $bookedDates) ? 'booked' : 'available'
            ];
        }

        return $dates;

    }

}
