<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

