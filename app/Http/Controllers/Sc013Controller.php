<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;


/**
 * Sc013Controller - Handles case management functionality
 * 
 * This controller manages the display and filtering of cases with their associated reports.
 * It provides pagination and search functionality for the admin interface.
 */
class Sc013Controller extends Controller
{
    public function index(Request $request)
    {
        // Get the number of entries to show per page (default: 10)
        $perPage = $request->input('show-entries', 10);
        
        // Build the query to get cases with their related reports, ordered by case_id
        $query = Cases::with('report')->orderBy('case_id', 'ASC');

        // Apply case_id filter if provided in the request
        if ($request->filled('case_id')) {
            $query->where('case_id', $request->input('case_id'));
        }

        // Execute the query with pagination
        $cases = $query->paginate($perPage);

        // Return the admin view with the cases data
        return view('admin.sc_013', compact('cases'));
    }

        
}
