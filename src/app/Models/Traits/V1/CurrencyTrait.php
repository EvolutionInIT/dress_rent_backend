<?php

namespace App\Models\Traits\V1;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait CurrencyTrait
{
    /**
     * @return HasOne
     */
    public function price(): HasOne
    {
        return $this
            ->hasOne(get_class($this) . 'Price', $this->primaryKey, $this->primaryKey)
            ->where('code', config('app.currency_code'));
    }

    /**
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this
            ->hasMany(get_class($this) . 'Price', $this->primaryKey, $this->primaryKey);
    }
}








