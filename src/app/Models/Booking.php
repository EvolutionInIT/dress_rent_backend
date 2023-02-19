<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUSES = [
        'NEW' => 'new',
        'CANCELED' => 'canceled',
        'APPROVED' => 'approved',
        'UNAPPROVED' => 'unapproved',
    ];

    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $fillable = ['dress_id', 'date', 'status', 'days', 'end_date'];

    protected $hidden = [
        'deleted_at'
    ];

    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function dress(): HasOne
    {
        return $this->hasOne(Dress::class, 'dress_id', 'dress_id');
    }


}
