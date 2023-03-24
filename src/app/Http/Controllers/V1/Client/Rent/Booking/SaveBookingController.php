<?php

namespace App\Http\Controllers\V1\Client\Rent\Booking;

use App\Http\Requests\V1\Client\Rent\Booking\SaveBookingRequest;
use App\Http\Resources\V1\Admin\Booking\BookingResource;
use App\Models\V1\Booking;
use Illuminate\Support\Carbon;

class SaveBookingController
{
    /**
     * @param SaveBookingRequest $request
     * @return BookingResource
     */
    public function save(SaveBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();
        $requestData['date'] = Carbon::parse($requestData['date']);

        $requestData['status'] = Booking::STATUSES['NEW'];
        $booking = Booking::create($requestData);
        $booking->dress->translation;

        return new BookingResource($booking);
    }
}
