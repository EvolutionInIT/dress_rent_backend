<?php

namespace App\Http\Resources\User;

use App\Http\Resources\CommonCollection;

class UserCollection extends CommonCollection
{
    public $collects = UserResource::class;
}
