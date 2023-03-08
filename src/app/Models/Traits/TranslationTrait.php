<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


trait TranslationTrait
{

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(get_class($this) . 'Translation', $this->primaryKey)
            ->where('language', config('app.current_language'));
    }

    /**
     * @return HasMany
     */
    public function translations(): HasMany
    {
        return $this->hasMany(get_class($this) . 'Translation', $this->primaryKey)
            ->where('language', config('app.current_language'));
    }
}








