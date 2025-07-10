<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageService
{
    /**
     * Danh sách các ngôn ngữ được hỗ trợ
     */
    const SUPPORTED_LOCALES = [
        'en' => ['name' => 'English', 'flag' => '🇺🇸', 'direction' => 'ltr'],
        'vi' => ['name' => 'Tiếng Việt', 'flag' => '🇻🇳', 'direction' => 'ltr'],
        'zh' => ['name' => '中文', 'flag' => '🇨🇳', 'direction' => 'ltr'],
        'es' => ['name' => 'Español', 'flag' => '🇪🇸', 'direction' => 'ltr'],
        'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'direction' => 'ltr'],
        'de' => ['name' => 'Deutsch', 'flag' => '🇩🇪', 'direction' => 'ltr'],
        'ja' => ['name' => '日本語', 'flag' => '🇯🇵', 'direction' => 'ltr'],
        'ko' => ['name' => '한국어', 'flag' => '🇰🇷', 'direction' => 'ltr'],
        'it' => ['name' => 'Italiano', 'flag' => '🇮🇹', 'direction' => 'ltr'],
        'ru' => ['name' => 'Русский', 'flag' => '🇷🇺', 'direction' => 'ltr'],
    ];

    /**
     * Kiểm tra xem ngôn ngữ có được hỗ trợ không
     */
    public static function isSupported($locale)
    {
        return array_key_exists($locale, self::SUPPORTED_LOCALES);
    }

    /**
     * Lấy danh sách tất cả ngôn ngữ được hỗ trợ
     */
    public static function getSupportedLocales()
    {
        return self::SUPPORTED_LOCALES;
    }

    /**
     * Lấy thông tin ngôn ngữ hiện tại
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
     * Đặt ngôn ngữ
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
     * Lấy ngôn ngữ từ session hoặc mặc định
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
     * Lấy fallback locale
     */
    public static function getFallbackLocale()
    {
        return config('app.fallback_locale', 'en');
    }

    /**
     * Kiểm tra xem key ngôn ngữ có tồn tại không
     */
    public static function hasTranslation($key, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        return \Illuminate\Support\Facades\Lang::has($key, $locale);
    }

    /**
     * Lấy bản dịch với fallback
     */
    public static function getTranslation($key, $parameters = [], $locale = null)
    {
        $locale = $locale ?? App::getLocale();

        // Kiểm tra xem key có tồn tại trong ngôn ngữ hiện tại không
        if (self::hasTranslation($key, $locale)) {
            return __($key, $parameters, $locale);
        }

        // Fallback về ngôn ngữ mặc định
        $fallbackLocale = self::getFallbackLocale();
        if (self::hasTranslation($key, $fallbackLocale)) {
            return __($key, $parameters, $fallbackLocale);
        }

        // Trả về key nếu không tìm thấy bản dịch
        return $key;
    }
}
