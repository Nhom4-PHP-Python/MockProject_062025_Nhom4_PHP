<?php

use Illuminate\Http\Request;
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

Route::get("/sc_004", function() {
    return view('sc_004');
});
Route::post("/sc_004", function(Request $request) {
    dd($request->all());
});
Route::get("/sc_005", function() {
    return view('sc_005');
});
Route::post("/sc_005", function(Request $request) {
    dd($request->all());
    // return view('sc_005');
});
Route::get("/sc_022", function() {
    return view('sc_022');
});
Route::post("/sc_022", function(Request $request) {
    dd($request->all());
});
Route::get("/sc_056", function() {
    return view('sc_056');
});
Route::post("/sc_056", function(Request $request) {
    dd($request->all());
});
Route::get("/sc_060", function() {
    return view('sc_060');
});
Route::post("/sc_060", function(Request $request) {
    dd($request->all());
});
