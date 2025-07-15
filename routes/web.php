<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SC012_013_016\Sc013Controller;
use App\Http\Controllers\SC012_013_016\Sc016Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sc010\ReportSc010Controller;
use App\Http\Controllers\ReportController\ReportController;
use App\Http\Controllers\Sc011Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('sc_001');
});

Route::get('/sc_001', [HomeController::class, 'index'])->name('sc_001');
Route::get('/sc_002', [HomeController::class, 'step1'])->name('sc_002');
Route::get('/sc_003', [HomeController::class, 'step2'])->name('sc_003');
Route::get('/sc_006', [HomeController::class, 'step3'])->name('sc_006');
// Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
//     Route::get('/sc_001', 'index')->name('sc_001');
//     Route::get('/sc_002', 'step1')->name('sc_002');
//     Route::get('/sc_003', 'step2')->name('sc_003');
//     Route::get('/sc_006', 'step3')->name('sc_006');
// });


Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('lang.switch');
Route::get('api/language/info', [LanguageController::class, 'getLanguageInfo'])->name('language.info');

// Report routes
Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
Route::get('/report/step1', [ReportController::class, 'step1'])->name('report.step1');
Route::post('/report/step1', [ReportController::class, 'postStep1'])->name('report.postStep1');
Route::get('/report/step2', [ReportController::class, 'step2'])->name('report.step2');
Route::post('/report/step2', [ReportController::class, 'postStep2'])->name('report.postStep2');
Route::get('/report/step3', [ReportController::class, 'step3'])->name('report.step3');
Route::get('/report/party/create', [ReportController::class, 'createParty'])->name('report.party.create');
Route::post('/report/party/store', [ReportController::class, 'storeParty'])->name('report.party.store');
Route::post('/report/party/store-ajax', [ReportController::class, 'storePartyAjax'])->name('report.party.storeAjax');
Route::get('/report/evidence/create', [ReportController::class, 'createEvidence'])->name('report.evidence.create');
Route::post('/report/evidence/store', [ReportController::class, 'storeEvidence'])->name('report.evidence.store');
Route::get('/report/confirm/{id}', [ReportController::class, 'confirm'])->name('report.confirm');
Route::get('/report/party/edit/{idx}', [ReportController::class, 'editParty'])->name('report.party.edit');
Route::post('/report/party/update/{idx}', [ReportController::class, 'updateParty'])->name('report.party.update');
Route::get('/report/party/delete/{idx}', [ReportController::class, 'deleteParty'])->name('report.party.delete');
Route::get('/report/evidence/edit/{idx}', [ReportController::class, 'editEvidence'])->name('report.evidence.edit');
Route::post('/report/evidence/update/{idx}', [ReportController::class, 'updateEvidence'])->name('report.evidence.update');
Route::get('/report/evidence/delete/{idx}', [ReportController::class, 'deleteEvidence'])->name('report.evidence.delete');

// Search routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/ajax/search', [SearchController::class, 'ajaxSearch'])->name('ajax.search');

//SC_11
Route::post('/sc_011/report/view',[Sc011Controller::class, 'view'])->name('report.view');
Route::post('/report/{id}/approve', [Sc011Controller::class, 'approve'])->name('report.approve');
Route::post('/report/{id}/reject', [Sc011Controller::class, 'reject'])->name('report.reject');



Route::group(['prefix' => 'admin'], function () {
    // Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resources([
        'sc_013' => Sc013Controller::class,
        'sc_016' => Sc016Controller::class,

    ]);
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Reports
// This route is protected by the 'check.session' middleware to ensure the user is logged in
Route::get('/reports', [ReportSc010Controller::class, 'index'])
    ->middleware('check.session')
    ->name('reports');
