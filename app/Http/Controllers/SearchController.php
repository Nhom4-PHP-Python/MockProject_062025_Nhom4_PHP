<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sc_001_002_003_006\Report;
use App\Models\sc_001_002_003_006\Party;
use App\Models\sc_001_002_003_006\Evidence;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    /**
     * Perform search
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if (!empty($query)) {
            // Search in reports
            $reports = Report::where('case_id', 'LIKE', "%{$query}%")
                ->orWhere('type_report', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('case_location', 'LIKE', "%{$query}%")
                ->orWhere('reporter_fullname', 'LIKE', "%{$query}%")
                ->get();

            // Search in evidence (if Evidence model exists)
            $evidence = collect(); // Empty collection if no Evidence model
            try {
                $evidence = Evidence::where('evidence_type', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhere('location', 'LIKE', "%{$query}%")
                    ->get();
            } catch (\Exception $e) {
                // Log the error for debugging
                Log::warning('Evidence search failed: ' . $e->getMessage());

                // Set evidence to empty collection and continue
                $evidence = collect();
            }

            $results = [
                'reports' => $reports,
                'evidence' => $evidence,
                'query' => $query,
                'total' => $reports->count() + $evidence->count()
            ];
        }

        return view('search_result', compact('results', 'query'));
    }

    /**
     * Search AJAX
     */
    public function ajaxSearch(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if (!empty($query) && strlen($query) >= 2) {
            // Quick search in reports
            $reports = Report::where('case_id', 'LIKE', "%{$query}%")
                ->orWhere('type_report', 'LIKE', "%{$query}%")
                ->orWhere('reporter_fullname', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(['report_id', 'case_id', 'type_report', 'reporter_fullname', 'reported_at']);

            $results = [
                'reports' => $reports,
                'has_more' => $reports->count() >= 5
            ];
        }

        return response()->json($results);
    }
}
