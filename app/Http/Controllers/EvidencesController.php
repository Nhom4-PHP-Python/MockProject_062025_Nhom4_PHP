<?php

namespace App\Http\Controllers;

use App\Models\Evidences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvidencesController extends Controller
{
    public function create() {
        $pageTitle = "Initial Evidence";
        $allReport = DB::table("reports")->select("report_id", "type_report")->get();
        return view("sc_005", compact("pageTitle", "allReport"));
    }
    public function store(Request $request) {
        // dd($request->all());
        $newEvidence = new Evidences();
        $newEvidence->create([
            "report_id" => $request->report_id,
            "current_location" => $request->location,
            "description" => $request->description,
            "attached_file" => json_encode($request->attachments) ?? null,    // transform files array to json string
        ]);
        return back()->with("success", "Evidence has been created successfully");
    }
}
