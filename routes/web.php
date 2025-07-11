<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController\ReportController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('sc_001');
});

Route::get('/sc_001', [App\Http\Controllers\HomeController::class, 'index'])->name('sc_001');
Route::get('/sc_002', [App\Http\Controllers\HomeController::class, 'step1'])->name('sc_002');
Route::get('/sc_003', [App\Http\Controllers\HomeController::class, 'step2'])->name('sc_003');
Route::get('/sc_006', [App\Http\Controllers\HomeController::class, 'step3'])->name('sc_006');

Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('lang.switch');
Route::get('api/language/info', [LanguageController::class, 'getLanguageInfo'])->name('language.info');

// Report routes
Route::post('/report/store', [App\Http\Controllers\ReportController\ReportController::class, 'store'])->name('report.store');
Route::get('/report/step1', [App\Http\Controllers\ReportController\ReportController::class, 'step1'])->name('report.step1');
Route::post('/report/step1', [App\Http\Controllers\ReportController\ReportController::class, 'postStep1'])->name('report.postStep1');
Route::get('/report/step2', [App\Http\Controllers\ReportController\ReportController::class, 'step2'])->name('report.step2');
Route::post('/report/step2', [App\Http\Controllers\ReportController\ReportController::class, 'postStep2'])->name('report.postStep2');
Route::get('/report/step3', [App\Http\Controllers\ReportController\ReportController::class, 'step3'])->name('report.step3');
Route::get('/report/party/create', [App\Http\Controllers\ReportController\ReportController::class, 'createParty'])->name('report.party.create');
Route::post('/report/party/store', [App\Http\Controllers\ReportController\ReportController::class, 'storeParty'])->name('report.party.store');
Route::post('/report/party/store-ajax', [App\Http\Controllers\ReportController\ReportController::class, 'storePartyAjax'])->name('report.party.storeAjax');
Route::get('/report/evidence/create', [App\Http\Controllers\ReportController\ReportController::class, 'createEvidence'])->name('report.evidence.create');
Route::post('/report/evidence/store', [App\Http\Controllers\ReportController\ReportController::class, 'storeEvidence'])->name('report.evidence.store');
Route::get('/report/confirm/{id}', [App\Http\Controllers\ReportController\ReportController::class, 'confirm'])->name('report.confirm');
Route::get('/report/party/edit/{idx}', [App\Http\Controllers\ReportController\ReportController::class, 'editParty'])->name('report.party.edit');
Route::post('/report/party/update/{idx}', [App\Http\Controllers\ReportController\ReportController::class, 'updateParty'])->name('report.party.update');
Route::get('/report/party/delete/{idx}', [App\Http\Controllers\ReportController\ReportController::class, 'deleteParty'])->name('report.party.delete');
Route::get('/report/evidence/edit/{idx}', [App\Http\Controllers\ReportController\ReportController::class, 'editEvidence'])->name('report.evidence.edit');
Route::post('/report/evidence/update/{idx}', [App\Http\Controllers\ReportController\ReportController::class, 'updateEvidence'])->name('report.evidence.update');
Route::get('/report/evidence/delete/{idx}', [App\Http\Controllers\ReportController\ReportController::class, 'deleteEvidence'])->name('report.evidence.delete');

// Search routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/ajax/search', [SearchController::class, 'ajaxSearch'])->name('ajax.search');
