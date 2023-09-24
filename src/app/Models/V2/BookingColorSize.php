<?php

namespace App\Models\V2;

use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\V1\Color;
use App\Models\V1\Size;

class BookingColorSize extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Traits
    use TranslationTrait;

    protected $table = 'booking_color_size';
    protected $primaryKey = 'booking_color_size_id';
    protected $fillable = [
        'booking_id', 'color_id', 'size_id', 'quantity', 'date_start', 'date_end'
    ];

    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function color(): HasOne
    {
        return $this->hasOne(Color::class, 'color_id', 'color_id');
    }


    /**
     * @return HasOne
     */
    public function size(): HasOne
    {
        return $this->hasOne(Size::class, 'size_id', 'size_id');
    }

}
