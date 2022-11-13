<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DressColor extends Model
{
    use HasFactory;

    protected $table = 'dress_color';
    protected $primaryKey = 'dress_color_id';
    protected $fillable = ['dress_id', 'color_id'];

    public $timestamps = false;
}
