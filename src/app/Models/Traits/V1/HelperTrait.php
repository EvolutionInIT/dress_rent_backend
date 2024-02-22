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

    /**
     * @return mixed
     */
    protected static function getTableName(): mixed
    {
        return (new static)->getTable();
    }
}
