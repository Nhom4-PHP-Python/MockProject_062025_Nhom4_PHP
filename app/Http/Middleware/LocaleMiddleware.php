<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Services\LanguageService;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getLocale($request);

        // Set locale for the application
        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Determine current locale
     */
    private function getLocale(Request $request)
    {
        // Priority: URL parameter -> Session -> Browser -> Default

        // 1. Check URL parameter
        if ($request->has('lang') && LanguageService::isSupported($request->get('lang'))) {
            $locale = $request->get('lang');
            Session::put('locale', $locale);
            return $locale;
        }

        // 2. Check Session
        if (Session::has('locale') && LanguageService::isSupported(Session::get('locale'))) {
            return Session::get('locale');
        }

        // 3. Check Accept-Language header from browser
        $acceptLanguage = $request->header('Accept-Language');
        if ($acceptLanguage) {
            $languages = explode(',', $acceptLanguage);
            foreach ($languages as $lang) {
                $lang = trim(substr($lang, 0, 2));
                if (LanguageService::isSupported($lang)) {
                    Session::put('locale', $lang);
                    return $lang;
                }
            }
        }

        // 4. Default to English
        $defaultLocale = config('app.locale', 'en');
        Session::put('locale', $defaultLocale);
        return $defaultLocale;
    }
}