<?php

namespace App\Models\V1\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';
    protected $primaryKey = 'permission_id';
    protected $fillable = ['permission'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permission', 'permission_id', 'user_id', 'permission_id', 'user_id');
    }
}
