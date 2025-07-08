<?php

namespace App\Http\Controllers;

use App\Models\InvestigationPlans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestigationPlansController extends Controller
{
    public function create() {
        $pageTitle = "Add the digital investigation information";
        $allCase = DB::table("cases")->select("case_id", "type_case")->get();
        return view('sc_056', compact("pageTitle", "allCase"));
    }
    public function store(Request $request) {
        // dd($request->all());

        $newInvestigation = new InvestigationPlans();
        $newInvestigation->create([
            "case_id" => $request->case_id,
            "plan_content" => $request->case_id ?? null,
            "result" => json_encode($request->attachments) ?? null,    // transform files array to json string
        ]);
        return back()->with("success", "Add new investigation plan successfully");
    }
}
