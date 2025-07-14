<?php

namespace App\Http\Controllers;

use App\Models\Sc009AndSc010\Cases;
use App\Models\SC011\Evidence;
use App\Models\SC011\Report;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Sc011Controller extends Controller
{
    // Display the report details page 
    public function view(Request $request)
    {
            $reportId = Crypt::decrypt($request->input('id'));
            $caseId = $request->input('case_id');
            $report = Report::find($reportId);
            $case = Cases::find($caseId); 

            $reports = Report::with(['victims', 'witnesses', 'accomplices', 'suspects'])
                        ->where('report_id', $reportId)
                        ->where('is_deleted', 0)
                        ->first();

            
            $evidences = Evidence::where('report_id', $reportId)
                                ->where('is_deleted', 0)
                                ->get();

            return view('sc_011.view_report', [
                'report' => $report,
                'case' => $case,
                'victims' => $reports?->victims ?? [],
                'witnesses' => $reports?->witnesses ?? [],
                'accomplices' => $reports?->accomplices ?? [],
                'suspects' => $reports?->suspects ?? [],
                'evidences' => $evidences,
            ]);
    }
    // To approve a report by updating its status to Approved
     public function approve($id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->status = 'Approved';
            $report->save();
            return redirect()->route('reports');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('reports');
        }
    }
    // To reject a report by setting its status to Rejected
    public function reject($id)
    {
         try {
            $report = Report::findOrFail($id); 
            $report->status = 'Rejected';
            $report->save();
            return redirect()->route('reports');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('reports');
        }
    }

 

    


   
    
}
