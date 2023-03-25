<?php

namespace App\Http\Controllers\V1\Client\Rent\Booking;

use App\Http\Requests\V1\Client\Rent\Booking\SaveBookingRequest;
use App\Http\Resources\V1\Client\Rent\Booking\BookingResource;
use App\Models\V1\Booking;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

class SaveBookingClientRentController
{
    /**
     * @param SaveBookingRequest $request
     * @return AnonymousResourceCollection
     */
    public function save(SaveBookingRequest $request): AnonymousResourceCollection
    {
        $requestData = $request->validated();
        $requestData['date'] = Carbon::parse($requestData['date']);

        $requestData['status'] = Booking::STATUSES['NEW'];

        $bookings = [];
        for ($i = 1; $i <= $requestData['quantity']; $i++) {
            $booking = Booking::create($requestData);
            $booking->dress->translation;
            $bookings[] = $booking;
        }

        return BookingResource::collection($bookings);
    }
}
