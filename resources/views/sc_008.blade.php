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
    <div class="d-flex justify-content-between text-muted mb-3 mt-4">
      <div class="col-md-6">
        <div ><strong>ReportID:</strong></div>
        <div><strong>Status:</strong></div>
      </div>
      <div class="col-md-6">
        <div><strong>Date:</strong></div>
        <div><strong>Time:</strong></div>
      </div>
    </div>

    <hr />
    <h5 class="text-center fw-bold">REPORT DETAIL</h5>

    <!-- My Information -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">MY INFORMATION</h6>
      <div class="row">
        <div class="col-md-6">Full name</div>
        <div class="col-md-6">Email</div>
        <div class="col-md-6 mt-2">Relationship to the incident</div>
        <div class="col-md-6 mt-2">Phone</div>
        <div class="col-md-6 mt-2">Address</div>
      </div>
    </div>

    <hr />

    <!-- Incident Information -->
    <div class="mt-4">
      <h6 class="text-danger fw-bold">INCIDENT INFORMATION</h6>
      <div class="row">
        <div class="col-md-6">Type of Crime</div>
        <div class="col-md-6">Severity</div>
        <div class="col-md-6 mt-2">Datetime of occurrence</div>
        <div class="col-md-6 mt-2">State</div>
        <div class="col-md-6 mt-2">Detailed address</div>
        <div class="col-md-6 mt-2">Description of the incident</div>
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
            <tr>
              <td>01</td><td>---</td><td>---</td><td>---</td><td>---</td>
            </tr>
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
            <tr><td>02</td><td>---</td><td>---</td><td>---</td><td>---</td></tr>
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
          <tbody><tr><td>03</td><td>---</td><td>---</td><td>---</td><td>---</td></tr></tbody>
        </table>
      </div>

      <!-- Accomplice -->
      <p class="fw-semibold">D/ Accomplice (optional)</p>
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-light">
            <tr><th>ID</th><th>Full Name</th><th>Gender</th><th>Nationality</th><th>Statement / Description</th></tr>
          </thead>
          <tbody><tr><td>04</td><td>---</td><td>---</td><td>---</td><td>---</td></tr></tbody>
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
              <td>01</td><td>Documentary</td><td>Location example</td><td>File Title.png</td><td>File Title.png</td>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
