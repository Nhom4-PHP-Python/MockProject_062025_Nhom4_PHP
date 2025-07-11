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
        <div><strong>ReportID: {{ $reports->report_id }}</strong></div>
        <div><strong>Status: {{ $reports->status }}</strong></div>
      </div>
      <div class="col-md-6">
         <div><strong>Date: {{ \Carbon\Carbon::parse($reports->reported_at)->format('Y-m-d') }}</strong></div>
        <div><strong>Time: {{ \Carbon\Carbon::parse($reports->reported_at)->format('H:i:s') }}</strong></div>
      </div>
    </div>

    <hr>

    <!-- Title -->
    <h5 class="text-center fw-semibold">REPORT DETAIL</h5>

    <!-- MY INFORMATION -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">MY INFORMATION</h6>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Full name: {{ $reports->reporter_fullname }}</div>
        <div class="col-md-6 fw-medium">Email:  {{ $reports->reporter_email }}</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Relationship to the incident:  {{ $reports->type_report }}</div>
        <div class="col-md-6 fw-medium">Phone:  {{ $reports->reporter_phonenumber }}</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Address:  {{ $reports->case_location }}</div>
      </div>
    </div>

    <hr>

    <!-- INCIDENT INFORMATION -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">INCIDENT INFORMATION</h6>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Type of Crime: {{ $reports->type_report }}</div>
        <div class="col-md-6 fw-medium">Severity: {{ $reports->type_report  }}</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Datetime of occurrence: {{ $reports->reported_at }}</div>
        <div class="col-md-6 fw-medium">State: {{ $reports->status }}</div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6 fw-medium">Detailed address: {{ $reports->case_location }}</div>
        <div class="col-md-6 fw-medium">Description of the incident: {{ $reports->description }}</div>
      </div>
    </div>
  </div>
  <div>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
