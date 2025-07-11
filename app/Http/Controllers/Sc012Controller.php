<?php

namespace App\Http\Controllers;

use App\Models\SC007_008_011_012\Report;
use Illuminate\Http\Request;

class Sc012Controller extends Controller
{
    public function index() {
    // Lấy tất cả các reports thuộc vụ án case_id = 1 và chưa bị xóa
    $reports = Report::where('is_deleted', 0)
                     ->get();

    return view('sc_012', compact('reports'));
}
     
}
