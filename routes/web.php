<?php

use App\Http\Controllers\InvestigationPlansController;
use App\Http\Controllers\EvidencesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// SC_004+005+022+056+060
Route::get('/sc_005', [EvidencesController::class, 'create']);
Route::post('/sc_005', [EvidencesController::class, 'store']);
Route::get('/sc_056', [InvestigationPlansController::class, 'create']);
Route::post('/sc_056', [InvestigationPlansController::class, 'store']);



Route::get("/demo", function() {
    return view('demo');
});
Route::get("/sc_004", function() {
    return view('sc_004');
});
Route::post("/sc_004", function(Request $request) {
    dd($request->all());
});
Route::get("/sc_022", function() {
    return view('sc_022');
});
Route::post("/sc_022", function(Request $request) {
    dd($request->all());
});
Route::get("/sc_060", function() {
    return view('sc_060');
});
Route::post("/sc_060", function(Request $request) {
    dd($request->all());
});
