<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserRefreshToken.
 *
 * @property string $id
 * @property string $access_token_id
 * @property bool $revoked
 * @property string|null $expires_at
 * @property-read \App\Models\UserAccessToken $accessToken
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken whereAccessTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRefreshToken whereRevoked($value)
 * @mixin \Eloquent
 */
class UserRefreshToken extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'access_token_id', 'revoked', 'expires_at',
    ];

    public function accessToken(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserAccessToken::class,'id', 'access_token_id');
    }
}
