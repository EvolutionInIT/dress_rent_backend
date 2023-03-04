<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait translation
{

    /**
     * @param string $relatedModel
     * @param string $foreignKey
     * @return HasMany
     */
    public function translation(string $relatedModel, string $foreignKey): HasMany
    {
        return $this->hasMany($relatedModel, $foreignKey);
    }
}




















