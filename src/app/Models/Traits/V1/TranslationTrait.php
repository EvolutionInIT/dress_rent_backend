<?php

namespace App\Models\Traits\V1;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait TranslationTrait
{
    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this
            ->hasOne(get_class($this) . 'Translation', $this->primaryKey, $this->primaryKey)
            ->where('language', config('app.language_code'));
    }

    /**
     * @return HasMany
     */
    public function translations(): HasMany
    {
        return $this
            ->hasMany(get_class($this) . 'Translation', $this->primaryKey, $this->primaryKey);
    }
}








