<?php

namespace App\Http\Controllers;

use App\Models\SC007_008_011_012\Evidence;
use App\Models\SC007_008_011_012\Report;
use App\Models\SC007_008_011_012\Victim;
use App\Models\SC007_008_011_012\Witness;
use Illuminate\Http\Request;

class Sc008Controller extends Controller
{
     public function index(Request $request)
    {
    $caseId = 1;
    $reportId = 1;
    $reports = [];
    // Get a specific report (including victims and witnesses)
   $report = Report::with(['victims', 'witnesses', 'accomplices', 'suspects'])
                ->where('report_id', $reportId)
                ->where('is_deleted', 0)
                ->first();

    // Get list of all reports by case_id
    if ($caseId) {
         $reports = Report::find($reportId);
        // $reports = Report::with(['victims', 'witnesses'])
        //                  ->where('case_id', $caseId)
        //                  ->where('is_deleted', 0)
        //                  ->get();
    }
$evidences = Evidence::where('report_id', $reportId)
                     ->where('is_deleted', 0)
                     ->get();
// dd($reports);
    return view('sc_008', [
        'reports' => $reports,
        'caseId' => $caseId,
        'victims' => $report?->victims ?? [],
        'witnesses' => $report?->witnesses ?? [],
        'accomplices' => $report?->accomplices ?? [],
        'suspects' => $report?->suspects ?? [],
        'evidences' => $evidences,
    ]);
    }
}
