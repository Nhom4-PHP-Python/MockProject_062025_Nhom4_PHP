<?php

namespace App\Http\Controllers\SC012_013_016;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SC012_013_016\Cases;


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
        
        // Gọi phương thức filter ở Model
        $query = Cases::filter($request->only(['case_id']));

        // Execute the query with pagination
        $cases = $query->paginate($perPage);

        // Return the admin view with the cases data
        return view('admin.sc_013', compact('cases'));
    }

        
}
