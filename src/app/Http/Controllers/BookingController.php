<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\ListBookingRequest;
use App\Http\Requests\Booking\SaveBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;

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
            'status' => Booking::NEW_BOOKING
        ]);

        return new BookingResource($booking);
    }
}
