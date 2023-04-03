<?php

namespace App\Http\Controllers\V2\Client\Rent\Booking;

use App\Http\Requests\V2\Client\Rent\Booking\SaveBookingRequest;
use App\Http\Resources\V2\Client\Rent\Booking\BookingResource;
use App\Models\V1\Booking;
use App\Models\V1\BookingComponent;
use App\Models\V1\DressComponent;
use App\Models\V2\BookingColorSize;
use Illuminate\Support\Carbon;

class SaveBookingClientRentController
{
    public function save(SaveBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();
        $requestData['date'] = Carbon::parse($requestData['date']);

        $requestData['status'] = Booking::STATUSES['NEW'];

        $booking = Booking::create($requestData);

        BookingColorSize
            ::create([
                'booking_id' => $booking->booking_id,
                'color_id' => $requestData['color_id'],
                'size_id' => $requestData['size_id'],
            ]);

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
                ];
            }
        }
        BookingComponent::insert($arrComponent);


        $booking->booking_component;
        $booking->dress->translation;
        $booking->booking_color_size;

        $booking->booking_color_size->color->translation;
        $booking->booking_color_size->size;

        return new BookingResource($booking);
    }
}
