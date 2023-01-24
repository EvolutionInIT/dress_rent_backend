<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\CommonCollection;

class BookingCollection extends CommonCollection
{
    public $collects = BookingResource::class;
}
