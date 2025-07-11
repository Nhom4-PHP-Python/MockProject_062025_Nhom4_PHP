<?php

namespace App\Http\Controllers;

use App\Models\SC007_008_011_012\Report;
use Illuminate\Http\Request;

class Sc011Controller extends Controller
{
    public function index(){
         $caseId = 1;
    $reportId = 1;
    $reports = [];

        if ($caseId) {
            // $reports = Report::where('case_id', $caseId)->where('is_deleted', 0)->get();
                $reports = Report::find($reportId);
        }

        return view('sc_011', compact('reports', 'caseId'));
    }
   
    
}
