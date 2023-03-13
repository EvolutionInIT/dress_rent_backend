<?php

namespace App\Models\V1;

use App\Models\Traits\V1\TranslationTrait;
use App\Models\V1\User\User;
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

    // Traits
    use TranslationTrait;


    protected $table = 'dress';
    protected $primaryKey = 'dress_id';
    protected $fillable =
        [
            'title', 'description', 'user_id', 'quantity'
        ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function category(): BelongsToMany
    {
        return $this
            ->belongsToMany(Category::class, DressCategory::class,
                'dress_id', 'category_id', 'dress_id', 'category_id')
            ->orderBy('category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function color(): BelongsToMany
    {
        return $this
            ->belongsToMany(Color::class, DressColor::class,
                'dress_id', 'color_id', 'dress_id', 'color_id')
            ->orderBy('color_id');
    }

    /**
     * @return BelongsToMany
     */
    public function size(): BelongsToMany
    {
        return $this
            ->belongsToMany(Size::class, DressSize::class,
                'dress_id', 'size_id', 'dress_id', 'size_id')
            ->orderBy('size_id');
    }

    /**
     * @return HasMany
     */
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'dress_id');
    }

    /**
     * @return HasMany
     */
    public function photo(): HasMany
    {
        return $this->hasMany(Photo::class, 'dress_id');
    }


}
