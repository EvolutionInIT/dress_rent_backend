<?php

namespace App\Models\V1;

use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingComponent extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Traits
    use TranslationTrait;

    protected $table = 'booking_component';
    protected $primaryKey = 'booking_component_id';
    protected $fillable = [
        'booking_id', 'component_id', 'date_start', 'date_end'
    ];

    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function component(): HasOne
    {
        return $this->hasOne(Component::class, 'component_id', 'component_id');
    }

    /**
     * @return HasMany
     */
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'booking_id', 'booking_id');
    }

}
