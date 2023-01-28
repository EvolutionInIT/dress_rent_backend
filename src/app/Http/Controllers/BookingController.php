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
            'status' => Booking::AVAILABLE_DRESS,
        ]);

        return new BookingResource($booking);
    }


    public function cancel(CancelBookingRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Booking
            ::where('dress_id', $requestData['dress_id'])
            ->update([
                'status' => Booking::UNAVAILABLE_DRESS
            ]);

        return response()->json(['data' => ['message' => 'booking canceled']], Response::HTTP_OK);
    }


    public function status(StatusBookingRequest $request): array
    {
        $requestData = $request->validated();

        $twoWeeksAgo = Carbon::now()->subWeeks(2);
        $today = Carbon::now();

        $dates = [];
        for ($date = $twoWeeksAgo; $date->lte($today); $date->addDay()) {
            $dates[] = $date->toDateString();
        }

        $datesStatus = [];
        foreach ($dates as $date) {
            $status = Booking
                ::whereIn('dress_id', $requestData['dress_id'])
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
