<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_user';
    protected $primaryKey = 'dress_user_id';
    protected $fillable = ['dress_id', 'user_id'];

    public $timestamps = false;

}
