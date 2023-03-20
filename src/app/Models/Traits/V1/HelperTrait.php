<?php

namespace App\Models\Traits\V1;

trait HelperTrait
{
    /**
     * @return mixed
     */
    protected static function getPrimaryKeyName(): mixed
    {
        return (new static)->getKeyName();
    }
}
