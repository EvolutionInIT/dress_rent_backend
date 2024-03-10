<?php

namespace App\Http\Middleware\V1;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            //Access token from the request
            $token = JWTAuth::parseToken();
            //Try authenticating user
            $user = $token->authenticate();
            if (!$user)
                return $this->unauthorized('jwt_invalid_token');
        } catch (TokenExpiredException $e) {
            //Thrown if token has expired
            return $this->unauthorized('jwt_expired_token');
        } catch (TokenInvalidException $e) {
            //Thrown if token invalid
            return $this->unauthorized('jwt_invalid_token');
        } catch (JWTException $e) {
            //Thrown if token was not found in the request.
            return $this->unauthorized('jwt_token_not_received');
        }

        $resource = substr($request->route()->getActionName(), strrpos($request->route()->getActionName(), '\\') + 1);
        if ($this->acl($user->permissions, $resource)) {
            $request->merge(array('AUTH' => $user));
            return $next($request);
        }

        return $this->unauthorized('jwt_user_not_have_permission_on_resource');
    }

    /**
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function unauthorized($message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => $message,
        ], 401);
    }

    /**
     * @param $userPermissions
     * @param string $resource
     * @return bool
     */
    private function acl($userPermissions, string $resource): bool
    {
        //ADMIN, CLIENT, SHOP_OWNER

        $PERMISSIONS = array(
            'ADMIN' => [
                'DressCatalogControllerAdmin@list',
                'DressCatalogControllerAdmin@get',
                'DressCatalogControllerAdmin@save',
                'DressCatalogControllerAdmin@update',
                'BookingController@status',
                'CategoryController@list',
                'ColorController@list',
                'SizeController@list',
            ],
            'CLIENT' => ['DressController@list']
        );

        foreach ($userPermissions as $permission) {

            if (in_array($resource, $PERMISSIONS[$permission->permission]))
                return true;
        }

        return false;
    }
}
