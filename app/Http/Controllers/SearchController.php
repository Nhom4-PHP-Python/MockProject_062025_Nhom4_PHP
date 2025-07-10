<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Party;
use App\Models\Evidence;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    /**
     * Thực hiện tìm kiếm
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if (!empty($query)) {
            // Tìm kiếm trong báo cáo
            $reports = Report::where('case_id', 'LIKE', "%{$query}%")
                ->orWhere('type_report', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('case_location', 'LIKE', "%{$query}%")
                ->orWhere('reporter_fullname', 'LIKE', "%{$query}%")
                ->get();

            // Tìm kiếm trong bằng chứng (nếu có model Evidence)
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

        return view('search-results', compact('results', 'query'));
    }

    /**
     * Tìm kiếm AJAX
     */
    public function ajaxSearch(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if (!empty($query) && strlen($query) >= 2) {
            // Tìm kiếm nhanh trong báo cáo
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
