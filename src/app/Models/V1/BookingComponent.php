<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingComponent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'booking_component';
    protected $primaryKey = 'booking_component_id';
    protected $fillable = ['booking_id', 'component_id'];

    public $timestamps = false;

}
