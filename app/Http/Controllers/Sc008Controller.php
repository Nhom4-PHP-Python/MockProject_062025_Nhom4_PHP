<?php

namespace App\Http\Controllers;

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
    $report = Report::with(['victims', 'witnesses'])
                    ->where('report_id', $reportId)
                    ->where('is_deleted', 0)
                    ->first();

    // Get list of all reports by case_id
    if ($caseId) {
        $reports = Report::with(['victims', 'witnesses'])
                         ->where('case_id', $caseId)
                         ->where('is_deleted', 0)
                         ->get();
    }

    return view('sc_008', [
        'reports' => $reports,
        'caseId' => $caseId,
        'victims' => $report?->victims ?? [],
        'witnesses' => $report?->witnesses ?? [],
    ]);
    }
     //Get all undeleted reports
    public function getAllActiveReports()
    {
        $reports = Report::where('is_deleted', 0)->get();
        return response()->json($reports);
    }

    //Get report by case_id
    public function getReportsByCaseId($caseId)
    {
        $reports = Report::where('case_id', $caseId)->where('is_deleted', 0)->get();
        return response()->json($reports);
    }

    // Get report by status
    public function getReportsByStatus($status)
    {
        $reports = Report::where('status', $status)->where('is_deleted', 0)->get();
        return response()->json($reports);
    }
   // Get Victim information by ID
    public function getVictimById($id)
    {
        $victim = Victim::where('victim_id', $id)
                        ->where('is_deleted', 0)
                        ->first();

        if (!$victim) {
            return response()->json(['message' => 'Victim not found'], 404);
        }

        return response()->json($victim);
    }

    // get Witness information by ID
    public function getWitnessById($id)
    {
        $witness = Witness::where('witness_id', $id)
                          ->where('is_deleted', 0)
                          ->first();

        if (!$witness) {
            return response()->json(['message' => 'Witness not found'], 404);
        }

        return response()->json($witness);
    }

}
