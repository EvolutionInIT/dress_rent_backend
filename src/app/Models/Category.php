<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Traits
    use Relations\translation;

    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = ['title', 'description', 'category_id'];

    public $timestamps = false;
}
