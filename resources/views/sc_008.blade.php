<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    .upload-tag {
      background-color: #f8f9fa;
      border-radius: 6px;
      padding: 6px 10px;
      margin: 4px;
      display: inline-block;
    }

    .upload-tag i {
      margin-left: 6px;
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-white text-dark">


  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-light">
    <i class="fa-solid fa-arrow-left"></i>
    <div class="d-flex gap-3">
      <i class="fa-regular fa-window-minimize" ></i>
      <i class="fa-regular fa-square"></i>
      <i class="fa-solid fa-xmark"></i>
    </div>
  </div>

  <div class="container py-4">
    <!-- Top Info -->
      <!-- Top Info -->
    <div class="d-flex justify-content-between text-muted mb-3 mt-4">
      <div class="col-md-6">
        <div ><strong>ReportID: {{ $reports->report_id }}</strong></div>
        <div><strong>Status: {{ $reports->status }}</strong></div>
      </div>
      <div class="col-md-6">
        <div><strong>Date: {{ \Carbon\Carbon::parse($reports->reported_at)->format('Y-m-d') }}</strong></div>
        <div><strong>Time: {{ \Carbon\Carbon::parse($reports->reported_at)->format('H:i:s') }}</strong></div>
      </div>
    </div>



    <hr />
    <h5 class="text-center fw-bold">REPORT DETAIL</h5>

    <!-- My Information -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">MY INFORMATION</h6>
      <div class="row">
        <div class="col-md-6">Full name:  {{ $reports->reporter_fullname }}</div>
        <div class="col-md-6">Email:  {{ $reports->reporter_email }}</div>
        <div class="col-md-6 mt-2">Relationship to the incident:  {{ $reports->type_report }}</div>
        <div class="col-md-6 mt-2">Phone:  {{ $reports->reporter_phonenumber }}</div>
        <div class="col-md-6 mt-2">Address:  {{ $reports->case_location }}</div>
      </div>
    </div>
    <hr />

    <!-- Incident Information -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">INCIDENT INFORMATION</h6>
      <div class="row">
        <div class="col-md-6">Type of Crime: {{ $reports->type_report }}</div>
        <div class="col-md-6">Severity: {{ $reports->type_report  }}</div>
        <div class="col-md-6 mt-2">Datetime of occurrence: {{ $reports->reported_at }}</div>
        <div class="col-md-6 mt-2">State: {{ $reports->status }}</div>
        <div class="col-md-6 mt-2">Detailed address: {{ $reports->case_location }}</div>
        <div class="col-md-6 mt-2">Description of the incident: {{ $reports->description }}</div>
      </div>
    </div>

    <hr />

    <!-- Relevant Info -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">RELEVANT INFORMATION</h6>
      <p class="text-primary fw-bold">I. Relevant Parties</p>

      <!-- Victim -->
      <p class="fw-semibold">A/ Victim (optional)</p>
      <div class="table-responsive">
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
            @foreach($victims as $victim)
                <tr>
                   <td>{{ $victim->victim_id }}</td>
                    <td>{{ $victim->fullname }}</td>
                    <td>{{ $victim->gender }}</td>
                    <td>{{ $victim->nationality }}</td>
                    <td>{{ $victim->description }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Witness -->
      <p class="fw-semibold">B/ Witness (optional)</p>
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-light">
            <tr>
              <th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th>
            </tr>
          </thead>
          <tbody>
              @foreach($witnesses as $witness)
                <tr>
                     <td>{{ $witness->witness_id }}</td>
                    <td>{{ $witness->fullname }}</td>
                    <td>{{ $witness->gender }}</td>
                    <td>{{ $witness->nationality }}</td>
                    <td>{{ $witness->description }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Suspect -->
      <p class="fw-semibold">C/ Suspect (optional)</p>
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-light">
            <tr><th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th></tr>
          </thead>
          <tbody>
             @foreach($suspects as $suspect)
                <tr>
                   <td>{{ $suspect->suspect_id }}</td>
                    <td>{{ $suspect->fullname }}</td>
                    <td>{{ $suspect->gender }}</td>
                    <td>{{ $suspect->nationality }}</td>
                    <td>{{ $suspect->description }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Accomplice -->
      <p class="fw-semibold">D/ Accomplice (optional)</p>
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-light">
            <tr><th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th></tr>
          </thead>
          <tbody>
             @foreach($accomplices as $accomplice)
                <tr>
                   <td>{{ $accomplice->accomplice_id }}</td>
                    <td>{{ $accomplice->fullname }}</td>
                    <td>{{ $accomplice->gender }}</td>
                    <td>{{ $accomplice->nationality }}</td>
                    <td>{{ $accomplice->description }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Evidence -->
      <p class="text-primary fw-bold">II. Initial Evidence</p>
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-light">
            <tr><th>ID</th><th>Type</th><th>Evidence Location</th><th>Description</th><th>Attachments</th></tr>
          </thead>
          <tbody>
            <tr>
                @foreach($evidences as $evidence)
                <tr>
                   <td>{{ $evidence->evidence_id }}</td>
                    <td>{{ $evidence->initial_condition }}</td>
                    <td>{{ $evidence->location_at_scene }}</td>
                    <td>{{ $evidence->detailed_description }}</td>
                    <td>{{ $evidence->attached_file }}</td>
                </tr>
            @endforeach

            </tr>
          </tbody>
        </table>
      </div>

      <!-- Uploaded files -->
      <div class="mt-3">
        <div class="upload-tag">
          <i class="fa-regular fa-file-pdf text-danger"></i> File Title.pdf
          <i class="fa-solid fa-xmark text-danger"></i>
        </div>
        <div class="upload-tag">
          <i class="fa-regular fa-file-image text-primary"></i> File Title.png
          <i class="fa-solid fa-xmark text-danger"></i>
        </div>
        <div class="upload-tag">
          <i class="fa-regular fa-file-pdf text-danger"></i> File Title.pdf
          <i class="fa-solid fa-xmark text-danger"></i>
        </div>
      </div>
    </div>
  </div>
  {{-- @if(isset($reports) && count($reports) > 0)
    <h3>Danh sách báo cáo cho Case ID: {{ $caseId }}</h3>
    <ul>
        @foreach ($reports as $report)
            <li>{{ $report->type_report }} </li>
            <li> {{ $report->description }}</li>
            <li> {{ $report->case_location }}</li>
            <li> {{ $report->reported_at }}</li>
            <li> {{ $report->reporter_fullname }}</li>
            <li> {{ $report->reporter_email }}</li>
            <li> {{ $report->reporter_phonenumber }}</li>
            <li> {{ $report->status }}</li>
            <li> {{ $report->officer_approve_username }}</li>
            <li> {{ $report->is_deleted }}</li>
        @endforeach
    </ul>
@elseif(isset($caseId))
    <p>Không tìm thấy báo cáo nào cho Case ID: {{ $caseId }}</p>
@endif --}}

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
