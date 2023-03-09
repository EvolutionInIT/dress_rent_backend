<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     * @throws ValidationException
     */
    public function handle(Request $request, Closure $next)
    {

        $validator = Validator::make($request->all(), [
            'code' => [
                'string',
                'size:2',
                function ($attribute, $value, $fail) {
                    $exists =
                        Language
                            ::where('code', $value)
                            ->where('show', true)
                            ->exists();
                    if (!$exists) {
                        $fail($attribute . ' is invalid.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $validator->errors(),
            ], 422);
        }

        $requestLang = $validator->validated();

        $lang =
            $requestLang['code']
            ?? env('DEFAULT_LANGUAGE_CODE')
            ?? 'en';

        $code =
            Language
                ::where('code', $lang)
                ->first();

        Config::set('app.language_code', $code->code);
        return $next($request);

    }
}
