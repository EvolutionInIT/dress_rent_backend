<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_category';
    protected $primaryKey = 'dress_category_id';
    protected $fillable = ['dress_id', 'category_id'];

    public $timestamps = false;

}
