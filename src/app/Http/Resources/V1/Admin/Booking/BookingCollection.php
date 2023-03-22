<?php

namespace App\Http\Resources\V1\Admin\Booking;

use App\Http\Resources\CommonCollection;

class BookingCollection extends CommonCollection
{
    public $collects = BookingResource::class;
}
