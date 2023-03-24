<?php

namespace App\Models\V1;

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
    protected $fillable = ['dress_id', 'date', 'status'];

    protected $hidden = [
        'deleted_at'
    ];

    protected $cast = [
        'dress_id' => 'integer',
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
