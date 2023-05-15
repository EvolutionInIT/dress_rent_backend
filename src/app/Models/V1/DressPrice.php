<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressPrice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_price';
    protected $primaryKey = 'dress_price_id';

    protected $fillable = ['dress_price_id', 'dress_id', 'code', 'price'];
}

