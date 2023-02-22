<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CancelBookingRequest;
use App\Http\Requests\Booking\ListBookingRequest;
use App\Http\Requests\Booking\SaveBookingRequest;
use App\Http\Requests\Booking\StatusBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingDateResource;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Models\Dress;
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

//        $dress = Dress::where('dress_id', $requestData['dress_id']);
//        $dress->increment('num_booking');

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
        )
            $dates[] = $date->toDateString();

        $datesStatus = [];


//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->select('dress_id', 'date')
//            ->addSelect(DB::raw('COUNT(*) as booking_count'))
//            ->with('dress:dress_id,title,quantity')
//            ->groupBy('dress_id', 'date')
//            ->get();

//        $status =
//            Booking
//                ::select('booking.booking_id', 'booking.dress_id', 'booking.date')
//                ->addSelect(DB::raw('(SELECT COUNT(*) FROM dress WHERE dress_id = booking.dress_id) as booking_count'))
//                ->get();


//        $status =
//            Dress
//                ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                    $q->whereIn('dress_id', $requestData['dress_id']);
//                })
//                ->select()
//                ->addSelect(DB::raw('(SELECT COUNT(*) FROM booking WHERE booking.dress_id = dress_id) as booking_count'))
//                ->get();
//
//        dd($status);


//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->select()
//            ->addSelect(DB::raw('(SELECT COUNT(*) FROM booking WHERE booking.dress_id = dress_id) as booking_count'))
//            ->with('dress:dress_id,title,quantity')
//            ->get();


//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->select('booking_id', 'dress_id', 'date', 'status', DB::raw('COUNT(*) as booking_count'))
//            ->with(['dress' => function ($q) {
//                $q->select('dress_id', 'quantity');
//            }])
//            ->groupBy('booking_id', 'dress_id', 'date', 'status')
//            ->havingRaw('booking_count < (SELECT quantity FROM dress WHERE dress.dress_id = booking.dress_id)')
//            ->get();

        $status = Booking
            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
                $q->whereIn('dress_id', $requestData['dress_id']);
            })
            ->whereIn('date', $dates)
            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
            ->select('booking_id', 'dress_id', 'date', 'status', DB::raw('COUNT(*) as booking_count'))
            ->with(['dress' => function ($q) {
                $q->select('dress_id', 'quantity');
            }])
            ->groupBy('booking_id', 'dress_id', 'date', 'status')
            ->havingRaw('booking_count < (SELECT quantity FROM dress
                            WHERE dress.dress_id = booking.dress_id AND quantity >
                            (SELECT COUNT(*) FROM booking WHERE booking.dress_id = dress.dress_id AND date BETWEEN ? AND ?))'
                , [Carbon::today(), Carbon::today()->addDays(14)])
            ->get();

        //dd($status);

        //dd($status->toArray());

//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->addSelect(DB::raw('COUNT(*) as booking_count, SUM(dress.quantity) as total_quantity'))
//            ->with(['dress' => function ($q) {
//                $q->select('dress_id', 'quantity');
//            }])
//            ->groupBy('dress_id')
//            ->havingRaw('total_quantity < dress.quantity')
//            ->get();

        //dd($status->toArray());

//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->select('booking_id', 'dress_id', 'date', 'status')
//            ->addSelect(DB::raw('COUNT(*) as booking_count'))
//            ->with('dress:dress_id,title,quantity')
//            ->groupBy('booking_id', 'dress_id', 'date', 'status')
//            ->get();

        //dd($status->toArray());

        foreach ($dates as &$date) {
            $datesStatus[] = [
                'date' => $date,
                'booking' => $status->where('date', $date)
            ];
        }

        return BookingDateResource::collection($datesStatus);
    }


    //    /**
//     * @param StatusBookingRequest $request
//     * @return AnonymousResourceCollection
//     */
//    public function statusMain(StatusBookingRequest $request): AnonymousResourceCollection
//    {
//        $requestData = $request->validated();
//
//        $dates = [];
//        for (
//            $date = Carbon::now();
//            $date->lte(Carbon::now()->addWeeks(2));
//            $date->addDay()
//        )
//            $dates[] = $date->toDateString();
//
//
//        $dress = Dress
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->withCount('booking')
//            ->having()    ///////  <-
//            ->addSelect()   /////  <-
//            ->get();
//
//        //dd($dress);
//
//        $dressFiltered =
//            $dress
//                ->filter(function ($dress) {
//                    return $dress->booking_count < $dress->quantity;
//                })
//                ->values()
//                ->pluck('dress_id');
//
//
//        $datesStatus = [];
//        $status = Booking
//            ::whereIn('dress_id', $dressFiltered)
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->with('dress:dress_id,title,quantity')
//            ->get();
//
//        foreach ($dates as &$date) {
//
//            $datesStatus[] = [
//                'date' => $date,
//                'booking' => $status->where('date', $date)
//            ];
//        }
//
//        return BookingDateResource::collection($datesStatus);
//    }

//    /**
//     * @param StatusBookingRequest $request
//     * @return AnonymousResourceCollection
//     */
//    public function status(StatusBookingRequest $request): AnonymousResourceCollection
//    {
//        $requestData = $request->validated();
//
//        $dates = [];
//        for (
//            $date = Carbon::now();
//            $date->lte(Carbon::now()->addWeeks(2));
//            $date->addDay()
//        )
//            $dates[] = $date->toDateString();
//
//        $datesStatus = [];
//
//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
//            ->select('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity', DB::raw('SUM(dress.num_booking) as num_booking'))
//            ->with('dress:dress_id,title,quantity,num_booking')
//            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
//            ->havingRaw('dress.quantity > num_booking')
//            ->get();
//
//        foreach ($dates as &$date) {
//            $datesStatus[] = [
//                'date' => $date,
//                'booking' => $status->where('date', $date)
//            ];
//        }
//
//        return BookingDateResource::collection($datesStatus);
//    }


//    /**
//     * @param StatusBookingRequest $request
//     * @return AnonymousResourceCollection
//     */
//    public function status(StatusBookingRequest $request): AnonymousResourceCollection
//    {
//        $requestData = $request->validated();
//
//        $dates = [];
//        for (
//            $date = Carbon::now();
//            $date->lte(Carbon::now()->addWeeks(2));
//            $date->addDay()
//        )
//            $dates[] = $date->toDateString();
//
//        $datesStatus = [];
//
//
////        $status = Dress
////            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////                $q->whereIn('dress_id', $requestData['dress_id']);
////            })
////            ->leftJoin('booking', function ($join) {
////                $join->on('dress.dress_id', '=', 'booking.dress_id')
////                    ->where('booking.status', '=', 'approved');
////            })
////            ->select('dress.*')
////            ->whereNull('booking.booking_id')
////            ->get();
//
//
////        $status = Booking
////            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////                $q->whereIn('dress_id', $requestData['dress_id']);
////            })
////            ->leftJoin('dress', function ($join) {
////                $join->on('booking.dress_id', '=', 'dress.dress_id')
////                    ->where('booking.status', '=', 'approved');
////            })
////            ->select('booking.*')
////            //->whereNull('booking.booking_id')
////            ->get();
////
////        dd($status);
//
////        $status = Booking
////            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////                $q->whereIn('dress_id', $requestData['dress_id']);
////            })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
////            ->select('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity', DB::raw('SUM(dress.num_booking) as num_booking'))
////            ->with('dress:dress_id,title,quantity,num_booking')
////            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
////            ->havingRaw('dress.quantity > num_booking')
////            ->get();
//
//        foreach ($dates as &$date) {
//            $datesStatus[] = [
//                'date' => $date,
//                'booking' => $status->where('date', $date)
//            ];
//        }
//
//        return BookingDateResource::collection($datesStatus);
//    }


//    /**
//     * @param StatusBookingRequest $request
//     * @return AnonymousResourceCollection
//     */
//    public function statusLast(StatusBookingRequest $request): AnonymousResourceCollection
//    {
//        $requestData = $request->validated();
//
//        $dates = [];
//        for (
//            $date = Carbon::now();
//            $date->lte(Carbon::now()->addWeeks(2));
//            $date->addDay()
//        )
//            $dates[] = $date->toDateString();
//
//        $datesStatus = [];
//
////        $status = Booking
////            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////                $q->whereIn('dress_id', $requestData['dress_id']);
////            })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
////            ->select('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity', DB::raw('SUM(dress.num_booking) as num_booking'))
////            ->with('dress:dress_id,title,quantity,booking_count')
////            ->withCount('dress as booking_count')
////            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
////            ->havingRaw('dress.quantity > booking_count')
////            ->get();
//
////        $status = Booking::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////            $q->whereIn('dress_id', $requestData['dress_id']);
////        })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
////            ->select('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
////            ->with('dress:dress_id,title,quantity')
////            ->withCount('dress as booking_count')
////            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
////            ->havingRaw('dress.quantity > booking_count')
////            ->get();
//
//        $status = Booking::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//            $q->whereIn('dress_id', $requestData['dress_id']);
//        })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
//            ->select('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
//            ->with(['dress' => function ($q) {
//                $q->select('dress_id', 'title', 'quantity')
//                    ->withCount('bookung');
//            }])
//            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
//            ->get();
//
//        dd($status);
//
//
////        $status = Booking::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////            $q->whereIn('dress_id', $requestData['dress_id']);
////        })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
////            ->select('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
////            ->with(['dress' => function ($q) {
////                $q->select('dress_id', 'title', 'quantity')
////                    ->selectSub(function ($q) {
////                        $q->from('booking')
////                            ->selectRaw('COUNT(*)')
////                            ->whereColumn('booking.dress_id', 'dress.dress_id')
////                            ->where('quantity', '>', 'booking_count');
////                    }, 'booking_count');
////            }])
////            ->withCount('dress as booking_count')
////            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date', 'dress.quantity')
////            ->havingRaw('dress.quantity > booking_count')
////            ->get();
////        dd($status);
//
////        $status = Booking::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////            $q->whereIn('dress_id', $requestData['dress_id']);
////        })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->select('booking.booking_id', 'booking.dress_id', 'booking.date')
////            ->with(['dress' => function ($q) {
////                $q->select('dress_id', 'dress.title', 'dress.quantity')
////                    ->selectSub(function ($q) {
////                        $q->from('booking')
////                            ->selectRaw('COUNT(*)')
////                            ->whereColumn('booking.dress_id', 'dress.dress_id')
////                            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)]);
////                    }, 'booking_count');
////            }])
////            ->groupBy('booking.booking_id', 'booking.dress_id', 'booking.date')
////            ->havingRaw('quantity > booking_count')
////            ->get();
//
//
//        foreach ($dates as &$date) {
//            $datesStatus[] = [
//                'date' => $date,
//                'booking' => $status->where('date', $date)
//            ];
//        }
//
//        return BookingDateResource::collection($datesStatus);
//    }


//    /**
//     * @param StatusBookingRequest $request
//     * @return AnonymousResourceCollection
//     */
//    public function status(StatusBookingRequest $request): AnonymousResourceCollection
//    {
//        $requestData = $request->validated();
//
//        $dates = [];
//        for (
//            $date = Carbon::now();
//            $date->lte(Carbon::now()->addWeeks(2));
//            $date->addDay()
//        )
//            $dates[] = $date->toDateString();
//
//        $datesStatus = [];
//
////        $status = Booking
////            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////                $q->whereIn('dress_id', $requestData['dress_id']);
////            })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->with('dress:dress_id,title,quantity')
////            ->get();
//
////        $status = Booking
////            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
////                $q->whereIn('dress_id', $requestData['dress_id']);
////            })
////            ->whereIn('date', $dates)
////            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
////            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
////            ->select('booking.*')
////            ->selectSub(function ($query) {
////                $query->selectRaw('COUNT(*)')
////                    ->from('booking')
////                    ->whereColumn('booking.dress_id', '=', 'dress.dress_id')
////                    ->where('booking.status', '!=', 'cancelled')
////                    ->as('booking_count');
////            }, 'booking_count')
////            ->whereColumn('booking_count', '<', 'dress.quantity')
////            ->get();
//
//
//        $status = Booking
//            ::when(!empty($requestData['dress_id']), function ($q) use ($requestData) {
//                $q->whereIn('dress_id', $requestData['dress_id']);
//            })
//            ->whereIn('date', $dates)
//            ->whereBetween('date', [Carbon::today(), Carbon::today()->addDays(14)])
//            ->join('dress', 'booking.dress_id', '=', 'dress.dress_id')
//            ->select('booking.*')
//            ->selectSub(function ($query) {
//                $query->selectRaw('COUNT(*)')
//                    ->from('booking')
//                    ->whereRaw('booking.dress_id = dress.dress_id')
//                    ->where('booking.status', '!=', 'cancelled');
//            }, 'booking_count')
//            ->havingRaw('booking_count < dress.quantity')
//            ->get();
//
//        foreach ($dates as &$date) {
//            $datesStatus[] = [
//                'date' => $date,
//                'booking' => $status->where('date', $date)
//            ];
//        }
//
//        return BookingDateResource::collection($datesStatus);
//    }

}
