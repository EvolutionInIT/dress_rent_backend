<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress';
    protected $primaryKey = 'dress_id';
    protected $fillable =
        [
            'title', 'description', 'category_id', 'user_id', 'color_id',
            'size_id', 'photo_id', 'image', 'image_small', 'dress_id'
        ];


    public $timestamps = false;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category(): BelongsToMany
    {
        return $this
            ->belongsToMany(Category::class, DressCategory::class,
                'dress_id', 'category_id');
    }

    public function color(): BelongsToMany
    {
        return $this
            ->belongsToMany(Color::class, DressColor::class,
                'dress_id', 'color_id');
    }

    public function size(): BelongsToMany
    {
        return $this
            ->belongsToMany(Size::class, DressSize::class,
                'dress_id', 'size_id');
    }

    /**
     * @return HasMany
     */
    public function photo(): HasMany
    {
        return $this->hasMany(Photo::class, 'dress_id');
    }

}
