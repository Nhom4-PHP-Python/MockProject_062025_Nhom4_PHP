<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Evidence;
use App\Models\Party;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class ReportController extends Controller
{
    // Step 1: Hiển thị form nhập thông tin người báo
    public function step1()
    {
        return view('sc_002');
    }

    // Step 1: Nhận dữ liệu, lưu vào session, chuyển sang step 2
    public function postStep1(Request $request)
    {
        $validated = $request->validate([
            'reporter_fullname' => 'required|string|max:100',
            'reporter_email' => 'required|email|max:100',
            'reporter_phonenumber' => 'required|string|max:20',
            'type_report' => 'required|string',
        ]);
        session(['report_step1' => $request->only(['reporter_fullname', 'reporter_email', 'reporter_phonenumber', 'type_report', 'case_location'])]);
        return redirect()->route('report.step2');
    }

    // Step 2: Hiển thị form nhập thông tin vụ việc
    public function step2()
    {
        $step1 = session('report_step1');
        if (!$step1) return redirect()->route('report.step1');
        return view('sc_003', compact('step1'));
    }

    // Step 2: Nhận dữ liệu, lưu vào database, chuyển sang step 3
    public function postStep2(Request $request)
    {
        $step1 = session('report_step1');
        if (!$step1) return redirect()->route('report.step1');
        $validated = $request->validate([
            'description' => 'nullable|string|max:1000',
            'incident_datetime' => 'required|date',
            'severity' => 'required|string',
            'type_report' => 'required|string',
        ]);

        if (!$step1) {
            return redirect()->route('report.step1')->withErrors('Step 1 data is missing.');
        }

        DB::beginTransaction();
        $uploadedFiles = []; // Track uploaded files for cleanup

        try {
            $report = Report::create([
                'reporter_fullname' => $step1['reporter_fullname'],
                'reporter_email' => $step1['reporter_email'],
                'reporter_phonenumber' => $step1['reporter_phonenumber'],
                'type_report' => $step1['type_report'],
                'case_location' => $step1['case_location'] ?? null,
                'description' => $request->description,
                'reported_at' => $request->incident_datetime,
                'officer_approve_id' => null,
                'is_deleted' => 0,
            ]);

            // Lưu các bên liên quan (Relevant Parties) từ session report_parties
            $parties = session('report_parties', []);
            foreach ($parties as $party) {
                $attachment = $party['attachment'] ?? null;
                if ($attachment) {
                    $uploadedFiles[] = $attachment;
                }
                Party::create([
                    'report_id' => $report->report_id,
                    'fullname' => $party['fullname'] ?? null,
                    'contact' =>  null,
                    'statement' =>  $party['statement'] ?? null,
                    'is_deleted' => 0,
                    // Nếu có các trường khác như relationship, gender, nationality thì thêm vào đây nếu DB có
                ]);
            }

            // Lưu các bên liên quan (Relevant Parties) vào bảng witness (cũ, giữ lại nếu cần backward compatibility)
            if ($request->has('party_role')) {
                $party_names = $request->party_name ?? [];
                $party_statements = $request->party_statement ?? [];
                $party_attachments = $request->file('party_attachment') ?? [];

                foreach ($request->party_role as $i => $role) {
                    $attachment = null;
                    if (isset($party_attachments[$i]) && $party_attachments[$i]) {
                        // Validate file before upload
                        $validated = $request->validate([
                            "party_attachment.$i" => 'file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
                        ]);

                        $attachment = $party_attachments[$i]->store('witness_attachments', 'public');
                        $uploadedFiles[] = $attachment; // Track for cleanup
                    }
                    Party::create([
                        'report_id' => $report->report_id,
                        'fullname' => $party_names[$i] ?? null,
                        'contact' =>  null,
                        'statement' =>  $party_statements[$i] ?? null,
                        'is_deleted' => 0,
                    ]);
                }
            }

            // Lưu bằng chứng vào bảng evidences
            if ($request->has('evidence_type')) {
                $evidence_locations = $request->evidence_location ?? [];
                Log::info('Evidence locations: ', $evidence_locations);
                $evidence_descriptions = $request->evidence_description ?? [];
                $evidence_attachments = $request->file('evidence_attachment') ?? [];

                foreach ($request->evidence_type as $i => $type) {
                    $attachment = null;
                    if (isset($evidence_attachments[$i]) && $evidence_attachments[$i]) {
                        // Validate file before upload
                        $validated = $request->validate([
                            "evidence_attachment.$i" => 'file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,avi'
                        ]);

                        $attachment = $evidence_attachments[$i]->store('evidence_attachments', 'public');
                        $uploadedFiles[] = $attachment; // Track for cleanup
                    }

                    Evidence::create([
                        'report_id' => $report->report_id,
                        'description' => $evidence_descriptions[$i] ?? null,
                        'current_location' => $evidence_locations[$i] ?? null,
                        'attached_file' => $attachment,
                        'status' => 'Pending',
                        'is_deleted' => 0,
                        // custom field
                        'type' => $type,
                    ]);
                }
            }

            // Lưu evidence từ session (nếu có)
            $evidences = session('report_evidences', []);
            foreach ($evidences as $evidence) {
                $attachment = $evidence['attachment'] ?? null;
                if ($attachment) {
                    $uploadedFiles[] = $attachment;
                }
                Evidence::create([
                    'report_id' => $report->report_id,
                    'description' => $evidence['description'] ?? null,
                    'current_location' => $evidence['location'] ?? null,
                    'attached_file' => $attachment,
                    'status' => 'Pending',
                    'is_deleted' => 0,
                    'type' => $evidence['type'] ?? null,
                ]);
            }

            session()->forget('report_step1');
            session()->forget('report_parties');
            session()->forget('report_evidences');
            DB::commit();
            return redirect()->route('report.confirm', ['id' => $report->report_id]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Cleanup uploaded files if transaction failed
            foreach ($uploadedFiles as $filePath) {
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

            return back()->withErrors(['error' => 'Lỗi lưu dữ liệu: ' . $e->getMessage()]);
        }
    }

    // Step 3: Xác nhận
    public function confirm($id)
    {
        $report = Report::findOrFail($id);
        return view('sc_006', compact('report'));
    }

    // Hiển thị form tạo mới relevant party (sc_004)
    // public function createParty()
    // {
    //     return view('sc_004');
    // }
    // Lưu relevant party vào session và quay lại step2
    public function storeParty(Request $request)
    {
        Log::info('storeParty called', $request->all());

        $validated = $request->validate([
            'fullname' => 'required|string|max:100',
            'relationship' => 'required|string',
            'gender' => 'nullable|string',
            'nationality' => 'nullable|string',
            'statement' => 'nullable|string',
        ]);

        Log::info('Validation passed', $validated);

        $parties = session('report_parties', []);

        $parties[] = [
            'fullname' => $validated['fullname'],
            'relationship' => $validated['relationship'],
            'gender' => $validated['gender'] ?? '',
            'nationality' => $validated['nationality'] ?? '',
            'statement' => $validated['statement'] ?? '',
        ];

        session(['report_parties' => $parties]);

        Log::info('Parties saved to session', $parties);

        return redirect()->route('report.step2')->with('success', __('messages.party_added'));
    }
    // Hiển thị form tạo mới initial evidence (sc_005)
    // public function createEvidence()
    // {
    //     return view('sc_005');
    // }
    // Lưu initial evidence vào session và quay lại step2
    public function storeEvidence(Request $request)
    {
        Log::info('storeEvidence called', $request->all());

        $validated = $request->validate([
            'type' => 'required|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        Log::info('Evidence validation passed', $validated);

        $evidences = session('report_evidences', []);

        // Xử lý file upload
        $attachment = null;
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            $uploadedFiles = [];

            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('evidence', $filename, 'public');
                $uploadedFiles[] = $path;
            }

            // Nếu có nhiều file, lưu file đầu tiên vào attachment
            $attachment = $uploadedFiles[0] ?? null;
        }

        $evidences[] = [
            'type' => $validated['type'],
            'location' => $validated['location'] ?? '',
            'description' => $validated['description'] ?? '',
            'attachment' => $attachment,
        ];

        session(['report_evidences' => $evidences]);

        Log::info('Evidence saved to session', $evidences);

        return redirect()->route('report.step2')->with('success', __('messages.evidence_added'));
    }

    // Hiển thị form chỉnh sửa relevant party
    public function editParty($idx)
    {
        $parties = session('report_parties', []);
        if (!isset($parties[$idx])) {
            return redirect()->route('report.step2')->withErrors('Party not found.');
        }
        $party = $parties[$idx];
        return view('sc_004', compact('party', 'idx'));
    }

    // Cập nhật relevant party
    public function updateParty(Request $request, $idx)
    {
        $parties = session('report_parties', []);
        if (!isset($parties[$idx])) {
            return redirect()->route('report.step2')->withErrors('Party not found.');
        }

        $validated = $request->validate([
            'relationship' => 'required|string',
            'fullname' => 'required|string',
            'statement' => 'nullable|string',
            'party_attachment' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        $oldAttachment = $parties[$idx]['attachment'] ?? null;
        $attachment = $oldAttachment;

        try {
            if ($request->hasFile('party_attachment')) {
                $attachment = $request->file('party_attachment')->store('witness_attachments', 'public');

                // Delete old file if upload successful
                if ($oldAttachment && Storage::disk('public')->exists($oldAttachment)) {
                    Storage::disk('public')->delete($oldAttachment);
                }
            }

            $parties[$idx] = [
                'relationship' => $validated['relationship'],
                'fullname' => $validated['fullname'],
                'statement' => $validated['statement'] ?? null,
                'attachment' => $attachment,
            ];

            session(['report_parties' => $parties]);
            return redirect()->route('report.step2');
        } catch (\Exception $e) {
            // Cleanup new uploaded file if something goes wrong, keep old file
            if ($attachment !== $oldAttachment && Storage::disk('public')->exists($attachment)) {
                Storage::disk('public')->delete($attachment);
            }

            return back()->withErrors(['error' => 'Lỗi cập nhật thông tin: ' . $e->getMessage()]);
        }
    }

    // Xóa relevant party
    public function deleteParty($idx)
    {
        $parties = session('report_parties', []);
        if (isset($parties[$idx])) {
            // Delete associated file if exists
            $attachment = $parties[$idx]['attachment'] ?? null;
            if ($attachment && Storage::disk('public')->exists($attachment)) {
                Storage::disk('public')->delete($attachment);
            }

            unset($parties[$idx]);
            $parties = array_values($parties); // reindex
            session(['report_parties' => $parties]);
        }
        return redirect()->route('report.step2');
    }

    // Hiển thị form chỉnh sửa evidence
    public function editEvidence($idx)
    {
        $evidences = session('report_evidences', []);
        if (!isset($evidences[$idx])) {
            return redirect()->route('report.step2')->withErrors('Evidence not found.');
        }
        $evidence = $evidences[$idx];
        return view('sc_005', compact('evidence', 'idx'));
    }

    // Cập nhật evidence
    public function updateEvidence(Request $request, $idx)
    {
        $evidences = session('report_evidences', []);
        if (!isset($evidences[$idx])) {
            return redirect()->route('report.step2')->withErrors('Evidence not found.');
        }

        $validated = $request->validate([
            'evidence_type' => 'required|string',
            'evidence_location' => 'nullable|string',
            'evidence_description' => 'nullable|string',
            'evidence_attachment' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,avi',
        ]);

        $oldAttachment = $evidences[$idx]['attachment'] ?? null;
        $attachment = $oldAttachment;

        try {
            if ($request->hasFile('evidence_attachment')) {
                $attachment = $request->file('evidence_attachment')->store('evidence_attachments', 'public');

                // Delete old file if upload successful
                if ($oldAttachment && Storage::disk('public')->exists($oldAttachment)) {
                    Storage::disk('public')->delete($oldAttachment);
                }
            }

            $evidences[$idx] = [
                'type' => $validated['evidence_type'],
                'location' => $validated['evidence_location'],
                'description' => $validated['evidence_description'],
                'attachment' => $attachment,
            ];

            session(['report_evidences' => $evidences]);
            return redirect()->route('report.step2');
        } catch (\Exception $e) {
            // Cleanup new uploaded file if something goes wrong, keep old file
            if ($attachment !== $oldAttachment && Storage::disk('public')->exists($attachment)) {
                Storage::disk('public')->delete($attachment);
            }

            return back()->withErrors(['error' => 'Lỗi cập nhật bằng chứng: ' . $e->getMessage()]);
        }
    }

    // Xóa evidence
    public function deleteEvidence($idx)
    {
        $evidences = session('report_evidences', []);
        if (isset($evidences[$idx])) {
            // Delete associated file if exists
            $attachment = $evidences[$idx]['attachment'] ?? null;
            if ($attachment && Storage::disk('public')->exists($attachment)) {
                Storage::disk('public')->delete($attachment);
            }

            unset($evidences[$idx]);
            $evidences = array_values($evidences); // reindex
            session(['report_evidences' => $evidences]);
        }
        return redirect()->route('report.step2');
    }

    // Step 3: Hiển thị thông tin xác nhận
    public function step3()
    {
        $reportId = session('report_step1.report_id');
        if (!$reportId) {
            return redirect()->route('report.step1');
        }

        $report = Report::find($reportId);
        if (!$report) {
            return redirect()->route('report.step1')->withErrors('Report not found.');
        }

        return view('sc_006', compact('report'));
    }
}