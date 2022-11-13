<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DressPhoto extends Model
{
    use HasFactory;

    protected $table = 'dress_photo';
    protected $primaryKey = 'dress_photo_id';
    protected $fillable = ['dress_id', 'photo_id'];

    public $timestamps = false;

}
