<?php

namespace App\Http\Middleware\V1;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class LangMiddleware
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
            'lang' => [
                'required',
                'string',
                'size:2',
                'exists:App\Models\V1\Language,code,enabled,1',
            ],
        ]);

        $code =
            $v->passes()
                ? $request->input('lang')
                : env('DEFAULT_LANGUAGE_CODE', "en");

        Config::set('app.language_code', $code);
        return $next($request);
    }
}
