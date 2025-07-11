<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SC012_013_016\Sc013Controller;
use App\Http\Controllers\SC012_013_016\Sc016Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportController;

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
    return view('welcome');
});

Route::get('/sc_011/report/view', [\App\Http\Controllers\Sc011Controller::class, 'showReportDetail' ]);
Route::get('/sc_011/report/form', [\App\Http\Controllers\Sc011Controller::class, 'showReportFormWithDetails' ]);

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
Route::get('/reports', [ReportController::class, 'index'])
    ->middleware('check.session')
    ->name('reports');
