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


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this
            ->belongsToMany(Category::class, DressCategory::class,
                'dress_id', 'category_id');
    }

    public function color(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this
            ->belongsToMany(Color::class, DressColor::class,
                'dress_id', 'color_id');
    }

    public function size(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this
            ->belongsToMany(Size::class, DressSize::class,
                'dress_id', 'size_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photo(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Photo::class, 'dress_id');
    }

}
