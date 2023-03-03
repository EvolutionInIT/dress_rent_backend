<?php

namespace App\Models\Relations;

use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait translation
{
    /**
     * @return HasMany
     */
    public function translation(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id');
    }
}
