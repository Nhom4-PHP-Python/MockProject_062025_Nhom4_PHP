<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />  
</head>
<body class="bg-white">

  <!-- Header bar -->
  <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom position-fixed top-0 w-100" style="background-color: #F3F3F3; z-index: 1030;">

    {{-- <i class="fa-solid fa-arrow-left"></i> --}}
    <a href="{{ route('reports') }}" class="btn btn-outline-secondary border-0 shadow-none">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div class="d-flex align-items-center">
       <a href="{{ route('reports') }}" class="btn btn-outline-secondary border-0 shadow-none mb-2">
             <i class="fa-regular fa-window-minimize me-2"></i>
        </a>
        <a href="#" class="btn btn-outline-secondary border-0 shadow-none ">
            <i class="fa-regular fa-square me-2"></i>
        </a>
        <a href="{{ route('reports') }}" class="btn btn-outline-secondary border-0 shadow-none ">
              <i class="fa-solid fa-xmark"></i>
        </a>

    </div>
  </div>

  <!-- Main Content -->
  <div  style="max-height: 760px; overflow-y: auto;">

        <div class="container py-4 my-5 " >
      
          @if(isset($report) && isset($case))
          <!-- Top Info -->
          <div class="d-flex justify-content-between text-muted mb-3 mt-4">
            <div class="col-md-6">
              <div><strong>ReportID: {{ $report->report_id ?? 'N/A' }}</strong></div>
              <div><strong>Status: {{ $report->status ?? 'N/A' }}</strong></div>
            </div>
            <div class="col-md-6">
              <div><strong>Date: {{ $report->reported_at ? \Carbon\Carbon::parse($report->reported_at)->format('Y-m-d') : 'N/A' }}</strong></div>
              <div><strong>Time: {{ $report->reported_at ? \Carbon\Carbon::parse($report->reported_at)->format('H:i:s') : 'N/A' }}</strong></div>
            </div>
          </div>
      
          <hr />
          
          <!-- Title -->
          <h5 class="text-center fw-bold">REPORT DETAIL</h5>
      
          <!-- My Information -->
          <div class="mt-4">
            <div class="fw-bold text-danger">MY INFORMATION</div>
            <div class="row mt-3">
              <div class="col-md-6">Full name: {{ $report->reporter_fullname ?? 'N/A' }}</div>
              <div class="col-md-6">Email: {{ $report->reporter_email ?? 'N/A' }}</div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">Relationship to the incident: {{ $report->type_report ?? 'N/A' }}</div>
              <div class="col-md-6">Phone: {{ $report->reporter_phonenumber ?? 'N/A' }}</div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">Address: {{ $report->case_location ?? 'N/A' }}</div>
            </div>
          </div>
      
          <hr class="my-4" />
      
          <!-- Incident Information -->
          <div>
            <div class="fw-bold text-danger">INCIDENT INFORMATION</div>
            <div class="row mt-3">
              <div class="col-md-6">Type of Crime: {{ $case->type_case ?? 'N/A' }}</div>
              <div class="col-md-6">Severity: {{ $case->severity ?? 'N/A' }}</div>
            </div>
            <div class="row mt-3">
              {{-- reported_at
              create_at --}}
              <div class="col-md-6">Date: {{ $case->create_at ?? 'N/A' }}</div>
              {{-- <div class="col-md-6">State: {{ $case->status ?? 'N/A' }}</div> --}}
              <div class="col-md-6">State: {{ $report->status ?? 'N/A' }}</div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">Detailed address: {{ $report->case_location ?? 'N/A' }}</div>
              <div class="col-md-6">Description of the incident: {{ $report->description ?? 'N/A' }}</div>
            </div>
          </div>
      
          <hr />
      
          <!-- Relevant Info -->
          <div class="mt-4">
            <h6 class="text-danger fw-bold">RELEVANT INFORMATION</h6>
            <p class="text-primary fw-bold">I. Relevant Parties</p>
      
            <!-- Victim -->
            <p class="fw-semibold">A/ Victim (optional)</p>
            <div class="table-responsive ms-5">
              <table class="table table-bordered table-sm">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Nationality</th>
                    <th>Statement / Description</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($victims ?? [] as $victim)
                    <tr>
                      <td>{{ $victim->victim_id  ?? 'N/A' }}</td>
                      <td>{{ $victim->fullname  ?? 'N/A' }}</td>
                      <td>{{ $victim->gender  ?? 'N/A' }}</td>
                      <td>{{ $victim->nationality  ?? 'N/A' }}</td>
                      <td>{{ $victim->description  ?? 'N/A' }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="5" class="text-center text-muted">No victim information available.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
      
            <!-- Witness -->
            <p class="fw-semibold">B/ Witness (optional)</p>
            <div class="table-responsive ms-5" >
              <table class="table table-bordered table-sm">
                <thead class="table-light">
                  <tr>
                    <th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($witnesses ?? [] as $witness)
                    <tr>
                      <td>{{ $witness->witness_id  ?? 'N/A' }}</td>
                      <td>{{ $witness->fullname  ?? 'N/A' }}</td>
                      <td>{{ $witness->gender  ?? 'N/A' }}</td>
                      <td>{{ $witness->nationality  ?? 'N/A' }}</td>
                      <td>{{ $witness->description  ?? 'N/A' }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="5" class="text-center text-muted">No witness information available.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
      
            <!-- Suspect -->
            <p class="fw-semibold">C/ Suspect (optional)</p>
            <div class="table-responsive ms-5">
              <table class="table table-bordered table-sm">
                <thead class="table-light">
                  <tr><th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th></tr>
                </thead>
                <tbody>
                  @forelse($suspects ?? [] as $suspect)
                    <tr>
                      <td>{{ $suspect->suspect_id  ?? 'N/A' }}</td>
                      <td>{{ $suspect->fullname  ?? 'N/A' }}</td>
                      <td>{{ $suspect->gender  ?? 'N/A' }}</td>
                      <td>{{ $suspect->nationality  ?? 'N/A' }}</td>
                      <td>{{ $suspect->description  ?? 'N/A' }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="5" class="text-center text-muted">No suspect information available.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
      
            <!-- Accomplice -->
            <p class="fw-semibold">D/ Accomplice (optional)</p>
            <div class="table-responsive ms-5">
              <table class="table table-bordered table-sm">
                <thead class="table-light">
                  <tr><th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th></tr>
                </thead>
                <tbody>
                  @forelse($accomplices ?? [] as $accomplice)
                    <tr>
                      <td>{{ $accomplice->accomplice_id  ?? 'N/A'  }}</td>
                      <td>{{ $accomplice->fullname  ?? 'N/A' }}</td>
                      <td>{{ $accomplice->gender  ?? 'N/A' }}</td>
                      <td>{{ $accomplice->nationality  ?? 'N/A' }}</td>
                      <td>{{ $accomplice->description  ?? 'N/A' }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="5" class="text-center text-muted">No accomplice information available.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
      
            <!-- Evidence -->
            <p class="text-primary fw-bold">II. Initial Evidence</p>
            <div class="table-responsive ms-5">
              <table class="table table-bordered table-sm">
                <thead class="table-light">
                  <tr><th>ID</th><th>Type</th><th>Evidence Location</th><th>Description</th><th>Attachments</th></tr>
                </thead>
                <tbody>
                  @forelse($evidences ?? [] as $evidence)
                    <tr>
                      <td>{{ $evidence->evidence_id  ?? 'N/A' }}</td>
                      <td>{{ $evidence->initial_condition  ?? 'N/A' }}</td>
                      <td>{{ $evidence->location_at_scene  ?? 'N/A' }}</td>
                      <td>{{ $evidence->detailed_description  ?? 'N/A' }}</td>
                      <td>{{ $evidence->attached_file  ?? 'N/A' }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="5" class="text-center text-muted">No evidence available.</td></tr>
                  @endforelse
                </tbody>
              </table>
              <div class="mt-3 " >
                <p >Uploaded:</p>
                <div class="d-flex">
                   @forelse($evidences ?? [] as $evidence)
                        <div class="upload-tag me-2">
                             {{ $evidence->attached_file }}
                        </div>
                    @empty
                        <div class="text-muted">No evidence file available.</div>
                    @endforelse
                  {{-- <div class="upload-tag me-2">
                    <i class="fa-regular fa-file-pdf text-danger"></i> File Title.pdf
                    <i class="fa-solid fa-xmark text-danger"></i>
                  </div> --}}
                </div>

              </div>

            </div>
      
            <!-- Uploaded files (demo only) -->
            
          </div>

          @else
            <div class="text-center text-danger mt-5">
              <h4>No report data found.</h4>
            </div>
          @endif
          
        </div>
  </div>

  <!-- Footer -->
  <div class="border-top py-3 px-4 d-flex justify-content-between align-items-center bg-light position-fixed bottom-0 w-100" style="z-index: 1030;background-color: #F3F3F3;">
    <button class="btn btn-secondary">Print</button>
    <div>
      {{-- <button class="btn btn-danger me-2">Decline</button>
      <button class="btn btn-primary">Approve</button> --}}
      {{-- @if(isset($report) --}}
      <form action="{{ route('report.approve', $report->report_id) }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-success">Approve</button>
      </form>
      <form action="{{ route('report.reject', $report->report_id) }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger">Reject</button>
      </form>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
