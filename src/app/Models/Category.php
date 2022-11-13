<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = ['title', 'description', 'category_id'];

    public $timestamps = false;

    public function dress()
    {
        return $this
            ->belongsToMany(Dress::class, DressCategory::class,
                'category_id', 'dress_id');
    }

}
