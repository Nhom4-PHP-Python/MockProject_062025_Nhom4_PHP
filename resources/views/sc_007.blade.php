<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-white text-dark" style="font-family: 'Segoe UI', sans-serif; font-size: 14px;">

  <!-- Header Bar -->
  <div class="bg-light border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
    <i class="fa-solid fa-arrow-left"></i>
    <div>
      <i class="fa-regular fa-window-minimize me-2"></i>
      <i class="fa-regular fa-square me-2"></i>
      <i class="fa-solid fa-xmark"></i>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container mt-4">
    <!-- Top Info -->
    <div class="d-flex justify-content-between mb-3 mt-4">
      <div class="col-md-6" >
        <div><strong>ReportID:</strong></div>
        <div><strong>Status:</strong></div>
      </div>
      <div class="col-md-6">
        <div><strong>Date:</strong></div>
        <div><strong>Time:</strong></div>
      </div>
    </div>

    <hr>

    <!-- Title -->
    <h5 class="text-center fw-semibold">REPORT DETAIL</h5>

    <!-- MY INFORMATION -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">MY INFORMATION</h6>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Full name</div>
        <div class="col-md-6 fw-medium">Email</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Relationship to the incident</div>
        <div class="col-md-6 fw-medium">Phone</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Address</div>
      </div>
    </div>

    <hr>

    <!-- INCIDENT INFORMATION -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">INCIDENT INFORMATION</h6>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Type of Crime</div>
        <div class="col-md-6 fw-medium">Severity</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Datetime of occurrence</div>
        <div class="col-md-6 fw-medium">State</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Detailed address</div>
        <div class="col-md-6 fw-medium">Description of the incident</div>
      </div>
    </div>
  </div>
  <div>

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

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
