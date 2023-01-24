<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\ListBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Models\Booking;
use Illuminate\Http\Request;

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
}
