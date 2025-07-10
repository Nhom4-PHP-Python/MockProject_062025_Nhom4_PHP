<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('sc_001');
    }
    public function step1()
    {
        return view('sc_002');
    }
    public function step2()
    {
        return view('sc_003');
    }
    public function step3()
    {
        return view('sc_006');
    }
}