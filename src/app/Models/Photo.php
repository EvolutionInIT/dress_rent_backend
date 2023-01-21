<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'photo';
    protected $primaryKey = 'photo_id';
    protected $fillable = ['photo_id', 'image', 'image_small'];

    public $timestamps = false;

    public function dress(): BelongsTo
    {
        return $this->belongsTo(Dress::class, 'dress_id');
    }
}

