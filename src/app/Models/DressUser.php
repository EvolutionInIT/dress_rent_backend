<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DressUser extends Model
{
    use HasFactory;

    protected $table = 'dress_user';
    protected $primaryKey = 'dress_user_id';
    protected $fillable = ['dress_id', 'user_id'];

    public $timestamps = false;

}
