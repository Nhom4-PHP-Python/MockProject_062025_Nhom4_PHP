{{-- resources/views/reports/report.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid reports-wrapper">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-2 sidebar bg-white p-4 d-flex flex-column justify-content-between" style="height: 100vh;">
      <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex align-items-center gap-3">
            <img src="{{ session('user')->avatar_url }}" class="rounded-circle" width="50" height="50" alt="Avatar">
            <h6 class="fw-bold text-uppercase mb-0">{{ session('user')->fullname }}</h6>
          </div>
          <button class="btn btn-sm btn-outline-secondary" id="toggleSidebar">
            <i class="fas fa-bars"></i>
          </button>
        </div>

        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <a href="#" class="nav-link text-dark">
              <i class="fas fa-tachometer-alt me-2 text-dark"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href="{{ route('reports') }}" class="nav-link active">
              <i class="fas fa-file-alt me-2"></i>
              <span>Reports</span>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href="#" class="nav-link text-dark">
              <i class="fas fa-briefcase me-2 text-dark"></i>
              <span>Cases</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="mt-auto">
        <a href="{{ route('logout') }}" class="btn btn-secondary w-100">
          <i class="fas fa-sign-out-alt me-2"></i>
          <span class="logout-text">Logout</span>
        </a>
      </div>
    </div>

    {{-- Main content --}}
    <div class="col-md-10 py-4 px-5 main-content" style="background-color: #66798A;">
      <div class="filters mb-3 d-flex gap-2 flex-wrap">
        <a href="{{ route('reports') }}" class="btn btn-outline-white">All</a>

        <!-- Dropdown Status -->
        <div class="dropdown">
          <button class="btn btn-outline-white dropdown-toggle" data-bs-toggle="dropdown" type="button">
            Status
          </button>
          <ul class="dropdown-menu">
            @foreach ($statuses as $s)
            <li><a class="dropdown-item" href="{{ route('reports', ['status' => $s]) }}">{{ ucfirst($s) }}</a></li>
            @endforeach
          </ul>
        </div>

        <!-- Dropdown Crime Type -->
        <div class="dropdown">
          <button class="btn btn-outline-white dropdown-toggle" data-bs-toggle="dropdown" type="button">
            Crime Type
          </button>
          <ul class="dropdown-menu">
            @foreach ($types as $t)
            <li><a class="dropdown-item" href="{{ route('reports', ['type' => $t]) }}">{{ $t }}</a></li>
            @endforeach
          </ul>
        </div>

        <!-- Dropdown Severity -->
        <div class="dropdown">
          <button class="btn btn-outline-white dropdown-toggle" data-bs-toggle="dropdown" type="button">
            Severity
          </button>
          <ul class="dropdown-menu">
            @foreach ($severities as $sv)
            <li><a class="dropdown-item" href="{{ route('reports', ['severity' => $sv]) }}">{{ $sv }}</a></li>
            @endforeach
          </ul>
        </div>

        <!-- Date range picker -->
        <form method="GET" action="{{ route('reports') }}" class="input-group input-group-sm" style="max-width: 300px;">
          <input type="text" name="created_at" id="created_at"
            class="form-control"
            placeholder="Select date range" value="{{ request('created_at') }}">
          <button type="submit" class="btn btn-outline-light">Apply</button>
        </form>


      </div>

      <div class="table-responsive rounded">
        <table class="table table-striped table-hover table-bordered">
          <thead class="table-light">
            <tr>
              <th>Report ID</th>
              <th>Type of Crime</th>
              <th>Severity</th>
              <th>Date</th>
              <th>Reporter</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reports as $report)
            <tr>
              <td>#{{ $report->report_id }}</td>
              <td>{{ $report->case->type_case ?? '-' }}</td>
              <td>{{ $report->case->severity ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($report->reported_at)->format('m/d/Y') }}</td>
              <td>{{ $report->reporter_fullname }}</td>
              <td>
                @php
                $status = strtolower($report->status);
                @endphp
                <span class="badge 
                                    @if($status === 'approved') bg-success
                                    @elseif($status === 'pending') bg-warning
                                    @elseif($status === 'rejected') bg-danger
                                    @else bg-secondary
                                    @endif
                                text-capitalize">{{ $status }}</span>
              </td>
              {{-- <td><a href="#" class="text-primary">View detail</a></td> --}}
              <td>
                   <form action="{{ route('report.view') }}" method="POST">
                      @csrf
                      {{-- $report->case_id --}}
                      <input type="hidden" name="id" value="{{ Crypt::encrypt($report->report_id) }}">
                      <input type="hidden" name="case_id" value="{{ $report->case_id }}">
                      <button type="submit" class="btn btn-primary">View Detail</button>
                  </form>

              </td>
  

            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7" class="text-end">
                {{-- Pagination --}}
                <div class="mt-3">
                  {{ $reports->links('pagination::bootstrap-5') }}
                </div>
              </td>
            </tr>
          </tfoot>

        </table>

      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush

@push('scripts')
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
  $(function() {
    $('#created_at').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear',

      }
    });

    $('#created_at').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('#created_at').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
  });
</script>
@endpush