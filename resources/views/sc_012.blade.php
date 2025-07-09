<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Investigation Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f7f8fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .user-info {
      position: absolute;
      top: 20px;
      right: 20px;
      text-align: right;
    }

    .avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #ccc;
    }

    .status-badge {
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 0.75rem;
      white-space: nowrap;
    }

    .badge-new {
      background-color: #ffe7cc;
      color: #e67e22;
    }

    .badge-phase {
      background-color: #d0f5dd;
      color: #27ae60;
    }

    .badge-pending {
      background-color: #ffe6e6;
      color: #e74c3c;
    }

    .table thead {
      background-color: #f0f0f0;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f9f9f9;
    }

    .search-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
  </style>
</head>

<body class="p-4">
    <div class="w-100 mb-3" style="background-color: #E7EDF6; height: 200px;">
      <div class="h-100 d-flex flex-column justify-content-between py-3">
        <div class="d-flex justify-content-end">
          <div class="bg-light p-2 rounded shadow-sm d-flex align-items-center">
            <div class="text-end me-2">
              <div class="fw-bold">MATTHA, JOHN</div>
              <div class="text-muted small">Sheriff</div>
            </div>
            <i class="fa-solid fa-right-from-bracket fs-5 text-dark"></i>
          </div>
        </div>
      
        <div class="d-flex justify-content-start" >
          <div class="bg-white px-3 py-2 rounded shadow-sm">
            <strong class="small">Preliminary Investigation</strong>
          </div>
        </div>

      </div>
    </div>




  <!-- Controls -->
  <div class="search-wrapper mb-3">
    <div class="d-flex align-items-center">
      <label class="me-2">Show</label>
      <select class="form-select form-select-sm w-auto me-2">
        <option>10</option>
        <option>25</option>
        <option>50</option>
      </select>
      <label class="me-2">entries</label>
    </div>
    {{-- <input type="text" class="form-control form-control-sm w-25" placeholder="Search..."> --}}
     <input type="text" class="form-control form-control-sm flex-grow-1" placeholder="Search...">
  </div>

  <!-- Table -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-sm align-middle text-center">
      <thead>
        <tr>
          <th>Case ID</th>
          <th>Type of Crime</th>
          <th>Level of severity</th>
          <th>Date</th>
          <th>Reporter</th>
          <th>Location</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#19333</td>
          <td>Property Crimes</td>
          <td>Misdemeanor</td>
          <td>22/05/2022</td>
          <td>MCK</td>
          <td>New York, NY</td>
          <td><span class="status-badge badge-new d-block w-100 text-center py-2">New Case</span></td>
        </tr>
        <tr>
          <td>#20462</td>
          <td>Violent Crimes</td>
          <td>3rd Degree Felony</td>
          <td>13/05/2022</td>
          <td>ToLin</td>
          <td>Chicago, IL</td>
          <td><span class="status-badge badge-new d-block w-100 text-center py-2">New Case</span></td>
        </tr>
        <tr>
          <td>#45169</td>
          <td>Drug Offenses</td>
          <td>3rd Degree Felony</td>
          <td>15/06/2022</td>
          <td>Den</td>
          <td>San Francisco, CA</td>
          <td><span class="status-badge badge-phase d-block w-100 text-center py-2">Processing in phase 2</span></td>
        </tr>
        <tr>
          <td>#34304</td>
          <td>Cybercrimes</td>
          <td>2nd Degree Felony</td>
          <td>06/09/2022</td>
          <td>Vau</td>
          <td>Chicago, IL</td>
          <td><span class="status-badge badge-new d-block w-100 text-center py-2">New Case</span></td>
        </tr>
        <tr>
          <td>#17188</td>
          <td>Drug Offenses</td>
          <td>Misdemeanor</td>
          <td>25/09/2022</td>
          <td>Thai</td>
          <td>Seattle, WA</td>
          <td><span class="status-badge badge-pending d-block w-100 text-center py-2">Pending approve in phase 3</span></td>
        </tr>
        <tr>
          <td>#73003</td>
          <td>Property Crimes</td>
          <td>Misdemeanor</td>
          <td>04/10/2022</td>
          <td>Subo</td>
          <td>Seattle, WA</td>
          <td><span class="status-badge badge-phase d-block w-100 text-center py-2">Processing in phase 2</span></td>
        </tr>
        <!-- Add more rows if needed -->
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-3">
    <nav>
      <ul class="pagination pagination-sm">
        <li class="page-item disabled"><a class="page-link">Previous</a></li>
        <li class="page-item active"><a class="page-link">1</a></li>
        <li class="page-item"><a class="page-link">2</a></li>
        <li class="page-item"><a class="page-link">3</a></li>
        <li class="page-item"><a class="page-link">Next</a></li>
      </ul>
    </nav>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



{{-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fff;
      font-family: 'Segoe UI', sans-serif;
      font-size: 14px;
    }

    .header-bar {
      background-color: #f5f5f5;
      padding: 8px 16px;
      border-bottom: 1px solid #ccc;
    }

    .window-controls i {
      cursor: pointer;
      margin-left: 12px;
      color: #4f4f4f;
    }

    .section-title {
      color: red;
      font-weight: 600;
    }

    .report-title {
      text-align: center;
      font-weight: 600;
      margin: 20px 0 10px 0;
    }

    .hr-line {
      border-top: 1px solid #bbb;
      margin: 20px 0;
    }

    .info-label {
      font-weight: 500;
    }

    .top-info {
      font-size: 13px;
      color: #555;
    }
  </style>
</head>

<body>
  <!-- Header Bar -->
  <div class="header-bar d-flex justify-content-between align-items-center">
    <i class="fa-solid fa-arrow-left"></i>
    <div class="d-flex align-items-center">
      <i class="fa-regular fa-window-minimize  me-2  "></i>
      <i class="fa-regular fa-square me-2"></i>
      <i class="fa-solid fa-xmark"></i>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container mt-4">
    <!-- Top Info: ReportID, Status, Date, Time -->
    <div class="d-flex justify-content-between top-info mb-3  mt-4 ">
      <div>
        <div><strong>ReportID:</strong></div>
        <div><strong>Status:</strong></div>
      </div>
      <div class="col-md-6">
        <div><strong>Date:</strong></div>
        <div><strong>Time:</strong></div>
      </div>
    </div>

    <hr />

    <!-- Title -->
    <h5 class="report-title">REPORT DETAIL</h5>

    <!-- MY INFORMATION -->
    <div class="mt-4">
      <div class="section-title">MY INFORMATION</div>
      <div class="row mt-2">
        <div class="col-md-6"><span class="info-label">Full name</span></div>
        <div class="col-md-6"><span class="info-label">Email</span></div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6"><span class="info-label">Relationship to the incident</span></div>
        <div class="col-md-6"><span class="info-label">Phone</span></div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6"><span class="info-label">Address</span></div>
      </div>
    </div>

    <hr class="hr-line" />

    <!-- INCIDENT INFORMATION -->
    <div class="mt-4">
      <div class="section-title">INCIDENT INFORMATION</div>
      <div class="row mt-2">
        <div class="col-md-6"><span class="info-label">Type of Crime</span></div>
        <div class="col-md-6"><span class="info-label">Severity</span></div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6"><span class="info-label">Datetime of occurrence</span></div>
        <div class="col-md-6"><span class="info-label">State</span></div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6"><span class="info-label">Detailed address</span></div>
        <div class="col-md-6"><span class="info-label">Description of the incident</span></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> --}}
