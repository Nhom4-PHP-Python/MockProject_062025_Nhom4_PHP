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


Route::get('sc_007', [\App\Http\Controllers\Sc007Controller::class, 'index' ]);
Route::get('sc_008', [\App\Http\Controllers\Sc008Controller::class, 'index' ]);
Route::get('sc_011', [\App\Http\Controllers\Sc011Controller::class, 'index' ]);
Route::get('sc_012', [\App\Http\Controllers\Sc012Controller::class, 'index' ]);


Route::get('/reports/{id}', [ReportController::class, 'show']);
