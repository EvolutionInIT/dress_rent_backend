<?php

namespace App\Models\V1;

use App\Models\V2\BookingColorSize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressSize extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_size';
    protected $primaryKey = 'dress_size_id';
    protected $fillable = ['dress_id', 'size_id'];

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function booking_color_size(): HasMany
    {
        return $this->hasMany(BookingColorSize::class, 'size_id', 'size_id');
    }
}
