<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DressCategory extends Model
{
    use HasFactory;

    protected $table = 'dress_category';
    protected $primaryKey = 'dress_category_id';
    protected $fillable = ['dress_id', 'category_id'];

    public $timestamps = false;

}
