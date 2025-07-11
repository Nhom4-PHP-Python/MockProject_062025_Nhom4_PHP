<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sc009AndSc010\Report;
use App\Models\Sc009AndSc010\Cases;

class ReportController extends Controller
{
  public function index(Request $request)
  {
    // Ensure user is authenticated (session check)
    if (!session()->has('user')) {
      return redirect()->route('login');
    }

    // Collect filter inputs from request
    $filters = $request->only(['status', 'type', 'severity', 'sort', 'created_at']);

    // Retrieve reports based on filters (pagination included inside the model)
    $reports = Report::getFilteredReports($filters);

    // Get distinct filter values for dropdown options in view
    $statuses = Report::select('status')->distinct()->pluck('status');
    $types = Cases::select('type_case')->distinct()->pluck('type_case');
    $severities = Cases::select('severity')->distinct()->pluck('severity');

    // Return the view with all required data
    return view('reports.report', compact('reports', 'statuses', 'types', 'severities'));
  }
}
