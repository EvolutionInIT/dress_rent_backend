<?php

namespace App\Http\Controllers\V1\Client\Rent\Booking;

use App\Http\Requests\V1\Client\Rent\Booking\SaveBookingRequest;
use App\Http\Resources\V1\Client\Rent\Booking\BookingResource;
use App\Models\V1\Booking;
use App\Models\V1\BookingComponent;
use App\Models\V1\DressComponent;
use Illuminate\Support\Carbon;

class SaveBookingClientRentController
{
    /**
     * @param SaveBookingRequest $request
     * @return BookingResource
     */
    public function save(SaveBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();
        $requestData['date'] = Carbon::parse($requestData['date']);
        $requestData['date_start'] = $requestData['date'];
        $requestData['date_end'] = $requestData['date'];

        $requestData['status'] = Booking::STATUSES['NEW'];

        $booking = Booking::create($requestData);

        if (!isset($requestData['component_id'])) {

            $dressComponents =
                DressComponent
                    ::select(['component_id', 'dress_id'])
                    ->where('dress_id', $requestData['dress_id'])
                    ->get()
                    ->pluck('component_id');

            $arrComponent = [];
            foreach ($dressComponents as $component_id) {
                $arrComponent[] = [
                    'booking_id' => $booking->booking_id,
                    'component_id' => $component_id,
                    'date' => $requestData['date'],
                    'date_start' => $requestData['date'],
                    'date_end' => $requestData['date'],
                ];
            }

        } else {
            $arrComponent = [];
            foreach ($requestData['component_id'] ?? [] as $key => $component_id) {
                $arrComponent[] = [
                    'booking_id' => $booking->booking_id,
                    'component_id' => $component_id,
                    'quantity' => $requestData['component_quantity'][$key],
                    'date' => $requestData['date'],
                    'date_start' => $requestData['date'],
                    'date_end' => $requestData['date'],
                ];
            }
        }
        BookingComponent::insert($arrComponent);

        $booking->booking_component;
        $booking->dress->translation;
        $booking->dress->user;

        return new BookingResource($booking);
    }
}
