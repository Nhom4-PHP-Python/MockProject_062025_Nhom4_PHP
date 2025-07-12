<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Services\LanguageService;

class LanguageController extends Controller
{
    /**
     * Change the application's language
     */
    public function changeLanguage(Request $request, $locale)
    {
        // Check if the locale is supported
        if (!LanguageService::isSupported($locale)) {
            return redirect()->back()->with('error', 'Language not supported.');
        }

        // Set the language
        $success = LanguageService::setLanguage($locale);

        if ($success) {
            $languageInfo = LanguageService::getSupportedLocales()[$locale];
            $languageName = $languageInfo['name'];

            return redirect()->back()->with('success', "Language switched to {$languageName}.");
        }

        return redirect()->back()->with('error', 'Unable to switch language.');
    }

    /**
     * Get the list of supported languages
     */
    public function getSupportedLanguages()
    {
        return LanguageService::getSupportedLocales();
    }

    /**
     * Get the current language
     */
    public function getCurrentLanguage()
    {
        return LanguageService::getCurrentLanguage();
    }

    /**
     * API endpoint to get language information
     */
    public function getLanguageInfo(Request $request)
    {
        return response()->json([
            'current' => LanguageService::getCurrentLanguage(),
            'supported' => LanguageService::getSupportedLocales()
        ]);
    }
}