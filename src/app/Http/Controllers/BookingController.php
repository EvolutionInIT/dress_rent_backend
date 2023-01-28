<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CancelBookingRequest;
use App\Http\Requests\Booking\ListBookingRequest;
use App\Http\Requests\Booking\SaveBookingRequest;
use App\Http\Requests\Booking\StatusBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
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


    public function save(SaveBookingRequest $request): array|BookingResource
    {
        $requestData = $request->validated();

        $booking = Booking::firstOrCreate($requestData, ['status' => Booking::UNAVAILABLE_DRESS,]);

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
            $booking->status = Booking::AVAILABLE_DRESS;
            $booking->save();
            return new BookingResource($booking);
        } else
            return response()->json(['message' => 'Booking not found'], 404);
    }


    public function status(StatusBookingRequest $request): array
    {
        $requestData = $request->validated();

        $today = Carbon::now();
        $twoWeeksLater = Carbon::now()->addWeeks(2);

        $dates = [];
        for ($date = $today; $date->lte($twoWeeksLater); $date->addDay()) {
            $dates[] = $date->toDateString();
        }

        $datesStatus = [];
        foreach ($dates as $date) {
            $status = Booking
                ::whereIn('dress_id', $requestData['dress_id'])
                ->where('status', 'unavailable')
                ->where('date', $date)
                ->get();
            if (!$status->isEmpty())
                $datesStatus[$date] = $status;
            else
                $datesStatus[$date] = 'available';
        }
        return $datesStatus;

    }


}
