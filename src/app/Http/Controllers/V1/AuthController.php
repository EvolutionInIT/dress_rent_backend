<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\Auth\RefreshRequest;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Common\AuthUserResource;
use App\Models\V1\User\User;
use App\Models\V1\User\UserRefreshToken;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController
{
    /**
     * @param LoginRequest $request
     * @return AuthUserResource|JsonResponse
     */
    public function login(LoginRequest $request): AuthUserResource|JsonResponse
    {
        $requestData = $request->validated();

        $user =
            User
                ::where('email', $requestData['email'])
                ->with('permissions')
                ->first();

        if ($user) {
            if (Hash::check($requestData['password'], $user->password)) {

                $authData = (new AuthService())->authUser($user);

                return (new AuthUserResource($user))
                    ->additional([
                        'access_token' => $authData['accessToken'],
                        'refresh_token' => $authData['refreshToken'],
                    ]);
            } else
                return response()->json(['errors' => ['password' => ['auth_login_error_incorrect_password']]], Response::HTTP_BAD_REQUEST);
        } else
            return response()->json(['errors' => ['email' => ['auth_login_user_not_found']]], Response::HTTP_BAD_REQUEST);
    }


    /**
     * @param RefreshRequest $request
     * @return AuthUserResource|Response
     */
    public function refreshToken(RefreshRequest $request): AuthUserResource|Response
    {
        $accessTokenId = $request->bearerToken();
        $refreshTokenId = $request->validated()['refresh_token'];

        if ($accessTokenId) {

            $refreshToken = UserRefreshToken
                ::where('id', $refreshTokenId)
                ->with('accessToken')
                ->first();

            if ($refreshToken && $refreshToken->accessToken) {

                if ($accessTokenId != $refreshToken->accessToken->id) {

                    $service = new AuthService();
                    $authData = $service->refreshToken($refreshToken);

                    if ($authData) {
                        return (new AuthUserResource($authData->user))
                            ->additional([
                                'access_token' => $authData->tokenInfo['accessToken'],
                                'refresh_token' => $authData->tokenInfo['refreshToken'],
                            ]);
                    } else
                        return response()->json(['error' => 'jwt_expired_refresh_token'], Response::HTTP_UNAUTHORIZED);
                } else
                    return response()->json(['error' => 'jwt_refresh_not_from_access_token'], Response::HTTP_UNAUTHORIZED);
            } else
                return response()->json(['error' => 'jwt_invalid_refresh_token'], Response::HTTP_UNAUTHORIZED);

        } else
            return response()->json(['error' => 'jwt_token_not_received'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param Request $request
     * @return AuthUserResource|Response
     */
    public function getAuthUser(Request $request): AuthUserResource|Response
    {

        if ($request->bearerToken()) {
            $service = new AuthService();

            if ($service->checkAuth())
                return (new AuthUserResource($service->getAuthUser()));
            else
                return response()->json(['error' => 'jwt_invalid_or_expired_token'], Response::HTTP_UNAUTHORIZED);
        } else
            return response()->json(['error' => 'jwt_token_not_received'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @return Response
     */
    public function logout(): Response
    {
        try {
            (new AuthService())->revokeTokens(auth()->user(), [], auth()->payload()['jti']);
            auth()->logout();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'jwt_invalid_or_expired_token'], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json(['message' => 'jwt_user_logout_successfully'], Response::HTTP_OK);
    }

}
