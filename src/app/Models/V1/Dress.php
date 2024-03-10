<?php

namespace App\Models\V1;

use App\Models\Traits\V1\HelperTrait;
use App\Models\Traits\V1\TranslationTrait;
use App\Models\Traits\V1\CurrencyTrait;
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
    use TranslationTrait, CurrencyTrait, HelperTrait;


    protected $table = 'dress';
    protected $primaryKey = 'dress_id';
    protected $fillable =
        [
            'title', 'description', 'user_id', 'quantity', 'price'
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
    public function categories(): BelongsToMany
    {
        return $this
            ->belongsToMany(Category::class, DressCategory::class,
                'dress_id', 'category_id', 'dress_id', 'category_id')
            ->orderBy('category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function component(): BelongsToMany
    {
        return $this
            ->belongsToMany(Component::class, DressComponent::class,
                'dress_id', 'component_id', 'dress_id', 'component_id')
            ->orderBy('component_id');
    }

    /**
     * @return BelongsToMany
     */
    public function colors(): BelongsToMany
    {
        return $this
            ->belongsToMany(Color::class, DressColor::class,
                'dress_id', 'color_id', 'dress_id', 'color_id')
            ->orderBy('color_id');
    }

    /**
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
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
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'dress_id');
    }

}
