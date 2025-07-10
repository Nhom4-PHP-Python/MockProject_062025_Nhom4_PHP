<?php

use Illuminate\Support\Facades\Route;
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
