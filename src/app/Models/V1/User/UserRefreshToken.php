<?php

namespace App\Models\V1\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRefreshToken extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'access_token_id', 'revoked', 'expires_at',
    ];

    /**
     * @return HasOne
     */
    public function accessToken(): HasOne
    {
        return $this->hasOne(UserAccessToken::class,'id', 'access_token_id');
    }
}
