<?php

namespace App\Http\Controllers\V2\Client\Rent\Booking;

use App\Http\Requests\V2\Client\Rent\Booking\SomeSaveBookingRequest;
use App\Http\Resources\V2\Client\Rent\Booking\BookingResource;
use App\Models\V1\Booking;
use App\Models\V1\BookingComponent;
use App\Models\V1\Component;
use App\Models\V1\Dress;
use App\Models\V1\DressColor;
use App\Models\V1\DressComponent;
use App\Models\V1\DressSize;
use App\Models\V2\BookingColorSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class SomeSaveBookingClientRentController
{
    /**
     * @param SomeSaveBookingRequest $request
     * @return JsonResponse|array
     */
    public function save(SomeSaveBookingRequest $request): JsonResponse|array
    {
        $requestData = $request->validated();

        $requestData['date_start'] = Carbon::parse($requestData['date_start']);
        $requestData['date_end'] = Carbon::parse($requestData['date_end']);
        $requestData['status'] = Booking::STATUSES['NEW'];

        $bookings = [];
        foreach ($requestData['booking'] as $bookingData) {

            $requestData['dress_id'] = $bookingData['dress_id'];
            $requestData['quantity'] = $bookingData['quantity'];

            $bookingDress =
                Dress
                    ::where('dress_id', $requestData['dress_id'])
                    ->withSum(
                        ['booking' => function ($q) use ($requestData) {
                            $q->where('date_start', $requestData['date_start']);
                        }],
                        'quantity'
                    )
                    ->first();


            if ($bookingDress->booking_sum_quantity + $requestData['quantity'] > $bookingDress->quantity) {
                return response()->json(['data' => ['message' => 'booking_save_dress_quantity_less_then_needed']], Response::HTTP_NOT_FOUND);
            }
            if ($requestData['quantity'] > $bookingDress->quantity) {
                return response()->json(['data' => ['message' => 'invalid_quantity']], Response::HTTP_NOT_FOUND);
            }

            $color_dressIds =
                DressColor
                    ::where('color_id', $bookingData['color_id'])
                    ->pluck('dress_id');

            $validColor = false;
            foreach ($color_dressIds as $id) {
                if ($id == $requestData['dress_id']) {
                    $validColor = true;
                    break;
                }
            }
            if (!$validColor) {
                return response()->json(['data' => ['message' => 'invalid_color_for_dress']], Response::HTTP_NOT_FOUND);
            }

            $color =
                DressColor
                    ::where('color_id', $bookingData['color_id'])
                    ->withSum(
                        ['booking_color_size' => function ($q) use ($requestData) {
                            $q->where('date_start', $requestData['date_start']);
                        }],
                        'quantity'
                    )
                    ->first();

            if ($color->booking_color_size_sum_quantity + $requestData['quantity'] > $color->quantity) {
                return response()->json(['data' => ['message' => 'booking_to_keep_the_number_of_color_less_than_necessary']], Response::HTTP_NOT_FOUND);
            }
            if ($requestData['quantity'] > $color->quantity) {
                return response()->json(['data' => ['message' => 'invalid_quantity']], Response::HTTP_NOT_FOUND);
            }

            $size_dressIds =
                DressSize
                    ::where('size_id', $bookingData['size_id'])
                    ->pluck('dress_id');

            $validSize = false;
            foreach ($size_dressIds as $id) {
                if ($id == $requestData['dress_id']) {
                    $validSize = true;
                    break;
                }
            }
            if (!$validSize) {
                return response()->json(['data' => ['message' => 'invalid_size_for_dress']], Response::HTTP_NOT_FOUND);
            }

            $size =
                DressSize
                    ::where('size_id', $bookingData['size_id'])
                    ->withSum(
                        ['booking_color_size' => function ($q) use ($requestData) {
                            $q->where('date_start', $requestData['date_start']);
                        }],
                        'quantity'
                    )
                    ->first();

            if ($size->booking_color_size_sum_quantity + $requestData['quantity'] > $size->quantity) {
                return response()->json(['data' => ['message' => 'booking_to_keep_the_number_of_size_less_than_necessary']], Response::HTTP_NOT_FOUND);
            }
            if ($requestData['quantity'] > $size->quantity) {
                return response()->json(['data' => ['message' => 'invalid_quantity']], Response::HTTP_NOT_FOUND);
            }

            foreach ($bookingData['components'] as $components) {

                $bookingComponent =
                    Component
                        ::where('component_id', $components['component_id'])
                        ->withSum(
                            ['booking_component' => function ($q) use ($requestData) {
                                $q->where('date_start', $requestData['date_start']);
                            }],
                            'quantity'
                        )
                        ->first();

                if ($bookingComponent->booking_component_sum_quantity + $components['quantity'] > $bookingComponent->quantity) {
                    return response()->json(['data' => ['message' => 'booking_to_keep_the_number_of_components_less_than_necessary']], Response::HTTP_NOT_FOUND);
                }
                if ($components['quantity'] > $bookingComponent->quantity) {
                    return response()->json(['data' => ['message' => 'invalid_component_quantity']], Response::HTTP_NOT_FOUND);
                }

                $component =
                    DressComponent
                        ::where('component_id', $components['component_id'])
                        ->first();

                if (!$component || $component->dress_id != $requestData['dress_id']) {
                    return response()->json(['data' => ['message' => 'invalid_component_for_dress']], Response::HTTP_NOT_FOUND);
                }
            }

            $booking = Booking::create($requestData);

            $requestData['booking_id'] = $booking->booking_id;
            $requestData['color_id'] = $bookingData['color_id'];
            $requestData['size_id'] = $bookingData['size_id'];

            BookingColorSize::create($requestData);

            if (!isset($bookingData['components'])) {
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
                        'date_start' => $requestData['date_start'],
                        'date_end' => $requestData['date_end'],
                    ];
                }
            } else {
                $arrComponent = [];
                foreach ($bookingData['components'] as $components) {
                    $arrComponent[] = [
                        'booking_id' => $booking->booking_id,
                        'component_id' => $components['component_id'],
                        'quantity' => $components['quantity'],
                        'date_start' => $requestData['date_start'],
                        'date_end' => $requestData['date_end'],
                    ];
                }
            }
            BookingComponent::insert($arrComponent);

            $booking->booking_component;
            $booking->dress->translation;
            $booking->booking_color_size;
            $booking->booking_color_size->color->translation;
            $booking->booking_color_size->size;

            $bookings[] = new BookingResource($booking);
        }
        return $bookings;
    }
}
