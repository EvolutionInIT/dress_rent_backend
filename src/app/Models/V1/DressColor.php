<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressColor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_color';
    protected $primaryKey = 'dress_color_id';
    protected $fillable = ['dress_id', 'color_id'];

    public $timestamps = false;
}
