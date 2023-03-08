<?php

namespace App\Http\Middleware;

use App\Http\Requests\Language\LanguageRequest;
use App\Models\Language;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param LanguageRequest $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //$requestLang = $request->input()->validated();
        //dd($requestLang);

        if ($request->input('language') ?? !$request->input('language')) {
            $language = Language::where('code', $request->input('language'))->first();

            if (!$language) {
                $language = Language::where('code', 'kk')->first();
            }

            Config::set('app.current_language', $language->code);
        }
        return $next($request);
    }
}
