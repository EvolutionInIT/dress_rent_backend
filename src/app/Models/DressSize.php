<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressSize extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_size';
    protected $primaryKey = 'dress_size_id';
    protected $fillable = ['dress_id', 'size_id'];

    public $timestamps = false;
}
