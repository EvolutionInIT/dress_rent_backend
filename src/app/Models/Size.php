<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'size';
    protected $primaryKey = 'size_id';
    protected $fillable = ['size_id', 'size'];

    public $timestamps = false;

    public function dress(): HasOne
    {
        return $this->hasOne(Dress::class, 'dress_id');
    }
}

