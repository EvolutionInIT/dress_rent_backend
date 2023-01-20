<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Color extends Model
{
    use HasFactory;

    protected $table = 'color';
    protected $primaryKey = 'color_id';
    protected $fillable = ['color_id', 'color'];

    public $timestamps = false;

    public function dress(): HasOne
    {
        return $this->hasOne(Dress::class, 'dress_id');
    }
}
