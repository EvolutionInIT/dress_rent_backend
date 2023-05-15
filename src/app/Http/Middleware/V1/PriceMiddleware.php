<?php

namespace App\Http\Middleware\V1;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class PriceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $v = Validator::make($request->all(), [
            'code' => [
                'required',
                'string',
                'size:3',
                'exists:App\Models\V1\DressPrice,code',
            ],
        ]);

        $code =
            $v->passes()
                ? $request->input('code')
                : env('DEFAULT_CURRENCY_CODE', "KZT");;

        Config::set('app.currency_code', $code);
        return $next($request);
    }
}
