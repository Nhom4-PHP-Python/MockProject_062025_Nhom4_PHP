<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageService
{
    /**
     * List of supported languages
     */
    const SUPPORTED_LOCALES = [
        'en' => ['name' => 'English', 'flag' => '🇺🇸', 'direction' => 'ltr'],
        'vi' => ['name' => 'Vietnamese', 'flag' => '🇻🇳', 'direction' => 'ltr'],
        'zh' => ['name' => 'Chinese', 'flag' => '🇨🇳', 'direction' => 'ltr'],
        'es' => ['name' => 'Spanish', 'flag' => '🇪🇸', 'direction' => 'ltr'],
        'fr' => ['name' => 'French', 'flag' => '🇫🇷', 'direction' => 'ltr'],
        'de' => ['name' => 'German', 'flag' => '🇩🇪', 'direction' => 'ltr'],
        'ja' => ['name' => 'Japanese', 'flag' => '🇯🇵', 'direction' => 'ltr'],
        'ko' => ['name' => 'Korean', 'flag' => '🇰🇷', 'direction' => 'ltr'],
        'it' => ['name' => 'Italian', 'flag' => '🇮🇹', 'direction' => 'ltr'],
        'ru' => ['name' => 'Russian', 'flag' => '🇷🇺', 'direction' => 'ltr'],
    ];

    /**
     * Check if the language is supported
     */
    public static function isSupported($locale)
    {
        return array_key_exists($locale, self::SUPPORTED_LOCALES);
    }

    /**
     * Get the list of all supported languages
     */
    public static function getSupportedLocales()
    {
        return self::SUPPORTED_LOCALES;
    }

    /**
     * Get current language info
     */
    public static function getCurrentLanguage()
    {
        $currentLocale = App::getLocale();
        return [
            'locale' => $currentLocale,
            'info' => self::SUPPORTED_LOCALES[$currentLocale] ?? self::SUPPORTED_LOCALES['en']
        ];
    }

    /**
     * Set language
     */
    public static function setLanguage($locale)
    {
        if (!self::isSupported($locale)) {
            return false;
        }

        Session::put('locale', $locale);
        App::setLocale($locale);
        return true;
    }

    /**
     * Get language from session or default
     */
    public static function getLanguage()
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (self::isSupported($locale)) {
                return $locale;
            }
        }

        return config('app.locale', 'en');
    }

    /**
     * Get fallback locale
     */
    public static function getFallbackLocale()
    {
        return config('app.fallback_locale', 'en');
    }

    /**
     * Check if language key exists
     */
    public static function hasTranslation($key, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        return \Illuminate\Support\Facades\Lang::has($key, $locale);
    }

    /**
     * Get translation with fallback
     */
    public static function getTranslation($key, $parameters = [], $locale = null)
    {
        $locale = $locale ?? App::getLocale();

        // Check if key exists in the current language
        if (self::hasTranslation($key, $locale)) {
            return __($key, $parameters, $locale);
        }

        // Fallback to default language
        $fallbackLocale = self::getFallbackLocale();
        if (self::hasTranslation($key, $fallbackLocale)) {
            return __($key, $parameters, $fallbackLocale);
        }

        // Return key if no translation found
        return $key;
    }
}
