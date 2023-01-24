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

    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $fillable = ['dress_id', 'date', 'status'];

    public $timestamps = false;

    public function photo(): HasMany
    {
        return $this->hasMany(Dress::class, 'dress_id');
    }
}
