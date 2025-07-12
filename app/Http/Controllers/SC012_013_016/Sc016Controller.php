<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SC012_013_016\User;

class Sc016Controller extends Controller
{
    // Display a list of users with role_id = 2, with optional filters and pagination
    public function index(Request $request)
    {
        // Get the number of entries to show per page from the request, default to 50
        $perPage = $request->input('show-entries', 50);
        // Start a query to select users with role_id = 2
        $query = User::where('role_id', 2);
        // If the 'fullname' filter is provided, add a LIKE condition to the query
        if ($request->filled('fullname')) {
            $query->where('fullname', 'like', '%' . $request->input('fullname') . '%');
        }
        // If the 'presentstatus' filter is provided, add a condition to the query
        if ($request->filled('presentstatus')) {
            $query->where('presentstatus', $request->input('presentstatus'));
        }
        // If the 'zone' filter is provided, add a condition to the query
        if ($request->filled('zone')) {
            $query->where('zone', $request->input('zone'));
        }
        // Paginate the results based on the perPage value
        $users = $query->paginate($perPage);
        // Get all distinct present statuses for users with role_id = 2
        $presentStatuses = User::where('role_id', 2)->distinct()->pluck('presentstatus');
        // Get all distinct zones for users with role_id = 2
        $zones = User::where('role_id', 2)->distinct()->pluck('zone');
        // Return the view with the users, present statuses, and zones data
        return view('admin.sc_016', compact('users', 'presentStatuses', 'zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
