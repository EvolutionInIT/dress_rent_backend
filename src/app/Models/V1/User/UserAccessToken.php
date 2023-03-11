<?php

namespace App\Models\V1\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAccessToken extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id', 'revoked', 'expires_at',
    ];

    /**
     * @return HasOne
     */
    public function refreshToken(): HasOne
    {
        return $this->hasOne(UserRefreshToken::class, 'access_token_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
