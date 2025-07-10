<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Services\LanguageService;

class LanguageController extends Controller
{
    /**
     * Thay đổi ngôn ngữ của ứng dụng
     */
    public function changeLanguage(Request $request, $locale)
    {
        // Kiểm tra locale có được hỗ trợ không
        if (!LanguageService::isSupported($locale)) {
            return redirect()->back()->with('error', 'Ngôn ngữ không được hỗ trợ.');
        }

        // Đặt ngôn ngữ
        $success = LanguageService::setLanguage($locale);

        if ($success) {
            $languageInfo = LanguageService::getSupportedLocales()[$locale];
            $languageName = $languageInfo['name'];

            return redirect()->back()->with('success', "Đã chuyển đổi ngôn ngữ thành {$languageName}.");
        }

        return redirect()->back()->with('error', 'Không thể chuyển đổi ngôn ngữ.');
    }

    /**
     * Lấy danh sách ngôn ngữ được hỗ trợ
     */
    public function getSupportedLanguages()
    {
        return LanguageService::getSupportedLocales();
    }

    /**
     * Lấy ngôn ngữ hiện tại
     */
    public function getCurrentLanguage()
    {
        return LanguageService::getCurrentLanguage();
    }

    /**
     * API endpoint để lấy thông tin ngôn ngữ
     */
    public function getLanguageInfo(Request $request)
    {
        return response()->json([
            'current' => LanguageService::getCurrentLanguage(),
            'supported' => LanguageService::getSupportedLocales()
        ]);
    }
}
