<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'color';
    protected $primaryKey = 'color_id';
    protected $fillable = ['color_id', 'color'];

    public $timestamps = false;

    public function dress(): HasOne
    {
        return $this->hasOne(Dress::class, 'dress_id');
    }
}
