<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\V2\BookingColorSize;

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
    protected $fillable =
        [
            'dress_id', 'status', 'email', 'phone_number', 'quantity', 'date_start', 'date_end'
        ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
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


    /**
     * @return BelongsToMany
     */
    public function booking_component(): BelongsToMany
    {
        return $this
            ->belongsToMany(Component::class, BookingComponent::class,
                'booking_id', 'component_id', 'booking_id', 'component_id')
            ->orderBy('component_id');
    }


    /**
     * @return HasOne
     */
    public function booking_color_size(): HasOne
    {
        return $this->hasOne(BookingColorSize::class, 'booking_id', 'booking_id');
    }

}
