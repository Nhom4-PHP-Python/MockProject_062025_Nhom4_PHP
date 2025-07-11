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
  <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
    <i class="fa-solid fa-arrow-left"></i>
    <div class="d-flex align-items-center">
      <i class="fa-regular fa-window-minimize me-2"></i>
      <i class="fa-regular fa-square me-2"></i>
      <i class="fa-solid fa-xmark"></i>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container py-4">

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

    <!-- Title -->
    <h5 class="text-center fw-bold">REPORT DETAIL</h5>

    <!-- My Information -->
    <div class="mt-4">
      <div class="fw-bold text-danger">MY INFORMATION</div>
      <div class="row mt-3">
        <div class="col-md-6">Full name:  {{ $reports->reporter_fullname }}</div>
        <div class="col-md-6">Email:  {{ $reports->reporter_email }}</div>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">Relationship to the incident:  {{ $reports->type_report }}</div>
        <div class="col-md-6">Phone:  {{ $reports->reporter_phonenumber }}</div>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">Address:  {{ $reports->case_location }}</div>
      </div>
    </div>

    <hr class="my-4" />

    <!-- Incident Information -->
    <div>
      <div class="fw-bold text-danger">INCIDENT INFORMATION</div>
      <div class="row mt-3">
        <div class="col-md-6">Type of Crime: {{ $reports->type_report }}</div>
        <div class="col-md-6">Severity: {{ $reports->type_report  }}</div>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">Date: {{ $reports->reported_at }}</div>
        <div class="col-md-6">State: {{ $reports->status }}</div>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">Detailed address: {{ $reports->case_location }}</div>
        <div class="col-md-6">Description of the incident: {{ $reports->description }}</div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="border-top py-3 px-4 d-flex justify-content-between align-items-center bg-light position-fixed bottom-0 w-100" style="z-index: 1030;">
  <button class="btn btn-secondary">Print</button>
  <div>
    <button class="btn btn-danger me-2">Decline</button>
    <button class="btn btn-primary">Approve</button>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
