<?php

namespace App\Services\V1;

use App\Models\UserAccessToken;
use App\Models\UserRefreshToken;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use stdClass;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthService
{
    /**
     * @param $user
     * @return array
     */
    public function authUser($user): array
    {
        $accessExpiredMinutes = env('API_AUTH_ACCESS_ALIVE', 60);
        $refreshExpiredMinutes = env('API_AUTH_REFRESH_ALIVE', 120);
        $ttlAccess = Carbon::now()->addMinutes($accessExpiredMinutes);
        $ttlRefresh = Carbon::now()->addMinutes($refreshExpiredMinutes);

        $jti = $this->generateJti($user->user_id);
        $jwt = auth('api')->claims(['jti' => $jti, 'exp' => $ttlAccess])->login($user);

        $accessToken = $this->createAccessToken($user, $jti, $ttlAccess);
        $refreshToken = $this->generateJti($accessToken->id);
        $this->createRefreshToken($refreshToken, $ttlRefresh, $accessToken);

        $data = [
            'accessToken' => $jwt,
            'refreshToken' => $refreshToken,
        ];

        return $data;
    }

    /**
     * @param string $login
     * @return string
     */
    public function generateJti(string $login)
    {
        return md5(uniqid($login, true));
    }

    /**
     * @param $user
     * @param string $id
     * @param $ttlAccess
     * @return mixed
     */
    public function createAccessToken($user, string $id, $ttlAccess)
    {
        return $user->accessTokens()->create([
            'id' => $id,
            'expires_at' => $ttlAccess,
        ]);
    }

    public function createRefreshToken(string $id, $ttlRefresh, $accessToken)
    {
        return $accessToken->refreshToken()->create([
            'id' => $id,
            'access_token_id' => $accessToken->id,
            'expires_at' => $ttlRefresh,
        ]);
    }

    public function getAuthUser()
    {
        return auth()->user();
    }

    public function checkAuth()
    {
        try {
            $payload = auth('api')->payload();
            $accessToken = UserAccessToken::where('id', $payload['jti'])->first();

            if ($accessToken)
                if ($accessToken->revoked == 0 && Carbon::parse($accessToken->expires_at)->timestamp > now()->timestamp)
                    return true;
        }
        catch (TokenExpiredException $e) {
            return false;
        }
        return false;
    }


    /**
     * @param $user
     * @param array $except_ids
     * @param null $revoke_token_id
     */
    public function revokeTokens($user, $except_ids = [], $revoke_token_id = null)
    {
        $except_ids = Arr::wrap($except_ids);

        if ($revoke_token_id == null) {
            $tokens_ids = $user->accessTokens()->whereNotIn('id', $except_ids)->pluck('id')->toArray();
        } else {
            $tokens_ids = Arr::wrap($revoke_token_id);
        }
        UserAccessToken::whereIn('id', $tokens_ids)->update([
            'revoked' => true,
        ]);
    }


    public function refreshToken($refreshToken)
    {
        if ($refreshToken) {
            if ($refreshToken->revoked == 0 && Carbon::parse($refreshToken->expires_at)->timestamp > now()->timestamp) {
                $accessToken = $refreshToken->accessToken;
                if ($accessToken && $accessToken->revoked == 0) {
                    $user = $accessToken->user;
                    if ($user) {
                        $this->revokeTokens($user, [], $accessToken->id);
                        $this->revokeRefreshToken($refreshToken);

                        $authData = new StdClass();
                        $authData->tokenInfo = $this->authUser($user);
                        $authData->user = $user;

                        return $authData;
                    }
                }
            }
        }
        return false;
    }


    public function revokeRefreshToken(UserRefreshToken $token)
    {
        $token->update([
            'revoked' => true,
        ]);
    }

}
