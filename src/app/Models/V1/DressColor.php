<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\V2\BookingColorSize;

class DressColor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_color';
    protected $primaryKey = 'dress_color_id';
    protected $fillable = ['dress_id', 'color_id'];

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function booking_color_size(): HasMany
    {
        return $this->hasMany(BookingColorSize::class, 'color_id', 'color_id');
    }

}
