<?php

namespace App\Models\V1\User;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'user_permission';
    protected $primaryKey = 'user_permission_id';
    protected $fillable = ['user_id', 'permission_id'];
}
