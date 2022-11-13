<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dress extends Model
{
    use HasFactory;

    protected $table = 'dress';
    protected $primaryKey = 'dress_id';
    protected $fillable =
        [
            'title', 'description', 'category_id', 'user_id', 'color_id',
            'size_id', 'photo_id', 'image', 'image_small', 'dress_id'
        ];


    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category()
    {
        return $this
            ->belongsToMany(Category::class, DressCategory::class,
                'dress_id', 'category_id');
    }

    public function color()
    {
        return $this
            ->belongsToMany(Color::class, DressColor::class,
                'dress_id', 'color_id');
    }

    public function size()
    {
        return $this
            ->belongsToMany(Size::class, DressSize::class,
                'dress_id', 'size_id');
    }

    public function photo()
    {
        return $this
            ->belongsToMany(Photo::class, DressPhoto::class,
                'dress_id', 'photo_id');
    }


}
