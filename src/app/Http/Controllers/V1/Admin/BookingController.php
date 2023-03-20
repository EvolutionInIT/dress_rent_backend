<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Booking\CancelBookingRequest;
use App\Http\Requests\V1\Admin\Booking\ListBookingRequest;
use App\Http\Requests\V1\Admin\Booking\SaveBookingRequest;
use App\Http\Requests\V1\Admin\Booking\StatusBookingRequest;
use App\Http\Resources\V1\Admin\Booking\BookingCollection;
use App\Http\Resources\V1\Admin\Booking\BookingDateResource;
use App\Http\Resources\V1\Admin\Booking\BookingResource;
use App\Models\V1\Booking;
use App\Models\V1\Dress;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class BookingController
{
    /**
     * @param ListBookingRequest $request
     * @return BookingCollection
     */
    public function list(ListBookingRequest $request): BookingCollection
    {
        $requestData = $request->validated();

        $booking =
            Booking
                ::select()
                ->paginate(
                    perPage: $requestData['per_page'] ?? 10,
                    page: $requestData['page'] ?? 1
                );

        return new BookingCollection($booking);
    }


    /**
     * @param SaveBookingRequest $request
     * @return BookingResource
     */
    public function save(SaveBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();

        $requestData['status'] = Booking::STATUSES['NEW'];
        $booking = Booking::create($requestData);

        return new BookingResource($booking);
    }


    /**
     * @param CancelBookingRequest $request
     * @return BookingResource
     */
    public function cancel(CancelBookingRequest $request): BookingResource
    {
        $requestData = $request->validated();

        $booking = Booking
            ::where('dress_id', $requestData['dress_id'])
            ->where('date', $requestData['date'])
            ->first();

        $booking->status = Booking::STATUSES['CANCELED'];
        $booking->save();
        return new BookingResource($booking);
    }


    /**
     * @param StatusBookingRequest $request
     * @return AnonymousResourceCollection
     */
    public function status(StatusBookingRequest $request): AnonymousResourceCollection
    {
        $requestData = $request->validated();

        $dates = [];
        for (
            $date = Carbon::now();
            $date->lte(Carbon::now()->addWeeks(2));
            $date->addDay()
        ) {
            $dates[] = $date->toDateString();
        }

//        $status =
//            Dress
//                ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                    $q->whereIn('dress_id', $requestData['dress_id']);
//                })
//                ->leftJoin('booking', function ($join) {
//                    $join->on('dress.dress_id', '=', 'booking.dress_id')
//                        ->where('booking.date', '>=', DB::raw('CURDATE()'))
//                        ->where('booking.date', '<=', DB::raw('DATE_ADD(CURDATE(), INTERVAL 2 WEEK)'));
//                })
//                ->select('dress.*', DB::raw('COUNT(booking.dress_id) as num_booking'))
//                ->groupBy('dress.dress_id', 'dress.quantity', 'dress.user_id',
//                    'dress.price', 'dress.created_at', 'dress.deleted_at', 'dress.updated_at')
//                ->havingRaw('dress.quantity > num_booking OR num_booking IS NULL')
//                ->get();

//        $status =
//            Dress
//                ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                    $q->whereIn('dress_id', $requestData['dress_id']);
//                })
//                ->leftJoin('booking', function ($join) {
//                    $join->on('dress.dress_id', '=', 'booking.dress_id')
//                        ->where('booking.date', '>=', DB::raw('CURDATE()'))
//                        ->where('booking.date', '<=', DB::raw('DATE_ADD(CURDATE(), INTERVAL 2 WEEK)'));
//                })
//                ->leftJoin('component', 'dress.dress_id', '=', 'component.dress_id')
//                ->select('dress.*', 'component.quantity as num_component', DB::raw('COUNT(booking.dress_id) as num_booking'))
//                ->groupBy('dress.dress_id', 'dress.quantity', 'dress.user_id', 'dress.price', 'dress.created_at', 'dress.deleted_at', 'dress.updated_at', 'component.quantity')
//                ->havingRaw('(dress.quantity - num_component) > num_booking OR num_booking IS NULL')
//                ->get();

        $status =
            Dress
                ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
                    $q->whereIn('dress_id', $requestData['dress_id']);
                })
                ->leftJoin('booking', function ($join) {
                    $join->on('dress.dress_id', '=', 'booking.dress_id')
                        ->where('booking.date', '>=', DB::raw('CURDATE()'))
                        ->where('booking.date', '<=', DB::raw('DATE_ADD(CURDATE(), INTERVAL 2 WEEK)'));
                })
                ->select('dress.*', DB::raw('COUNT(booking.dress_id) as num_booking'))
                ->groupBy('dress.dress_id', 'dress.quantity', 'dress.user_id',
                    'dress.price', 'dress.created_at', 'dress.deleted_at', 'dress.updated_at')
                ->havingRaw('dress.quantity > num_booking OR num_booking IS NULL')
                ->get();

        $datesStatus = [];

        foreach ($dates as $date) {

            $datesStatus[] = [
                'date' => $date,
                'booking' => $status
            ];
        }

//        return [
//            'date' => $this->date,
//            'booking' => DressResource::collection($this->booking),
//            'components' => ComponentResource::collection($this->booking->components)->with('dress'),
//        ];

        return BookingDateResource::collection($datesStatus);
    }

}
