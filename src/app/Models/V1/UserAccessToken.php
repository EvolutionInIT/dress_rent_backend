<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\UserAccessToken.
 *
 * @property string $id
 * @property int|null $user_id
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expires_at
 * @property-read \App\Models\UserRefreshToken $refreshToken
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccessToken whereUserId($value)
 * @method static whereIn(string $string, $tokens_ids)
 * @method static find($id)
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $user
 */
class UserAccessToken extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id', 'revoked', 'expires_at',
    ];

    /**
     * @return HasOne
     */
    public function refreshToken()
    {
        return $this->hasOne(UserRefreshToken::class, 'access_token_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
