<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sc013Controller;
use App\Http\Controllers\Sc016Controller;
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

Route::group(['prefix' => 'admin'], function () {
    // Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    Route::resources([
        'sc_013' => Sc013Controller::class,
        'sc_016' => Sc016Controller::class,
        
    ]);
});
