<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    const NEW_BOOKING = 'new';
    const CANCELED_BOOKING = 'canceled';
    const APPROVED_BOOKING = 'approved';
    const UNAPPROVED_BOOKING = 'unapproved';


    const AVAILABLE_DRESS = 'available';
    const UNAVAILABLE_DRESS = 'unavailable';


    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $fillable = ['dress_id', 'date', 'status'];

    protected $hidden = [
        'deleted_at'
    ];

    public $timestamps = false;

    public function photo(): HasMany
    {
        return $this->hasMany(Dress::class, 'dress_id');
    }
}
