<?php

namespace App\Http\Controllers;

use App\Models\SC011\Evidence;
use App\Models\SC011\Report;
use Illuminate\Http\Request;

class Sc011Controller extends Controller
{
    // Display the report details page 
    public function showReportDetail(){
         $caseId = 1;
    $reportId = 1;
    $reports = [];
// Only retrieve 1 report by report_id
        if ($caseId) {
            // $reports = Report::where('case_id', $caseId)->where('is_deleted', 0)->get();
                $reports = Report::find($reportId);
        }

        return view('sc_011.view_report', compact('reports', 'caseId'));
    }
    // Display the report form page 
     public function showReportFormWithDetails(Request $request) {
        $caseId = 1;
        $reportId = 1;
        $reports = [];
        // Retrieve a single report along with its related victims, witnesses, accomplices, and suspects
        $report = Report::with(['victims', 'witnesses', 'accomplices', 'suspects'])
                    ->where('report_id', $reportId)
                    ->where('is_deleted', 0)
                    ->first();

        // Get 1 reports by reportId
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
        // Return the form view with all related data
        return view('sc_011.form_report', [
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
