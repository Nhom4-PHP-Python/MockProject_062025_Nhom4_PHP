@extends('layouts.app')
@section('title', 'Crime Report - Step 3')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white px-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Report</li>
            <li class="breadcrumb-item"><a href="{{ route('report.step1') }}">Step 1</a></li>
            <li class="breadcrumb-item"><a href="{{ route('report.step2') }}">Step 2</a></li>
            <li class="breadcrumb-item active" aria-current="page">Step 3</li>
        </ol>
    </nav>
    <h3 class="text-center fw-bold mb-4">CRIME REPORT</h3>
    <div class="d-flex justify-content-center mb-4">
        <div class="stepper d-flex justify-content-between w-50">
            <div class="step">1</div>
            <div class="step-line"></div>
            <div class="step">2</div>
            <div class="step-line"></div>
            <div class="step active">3</div>
        </div>
    </div>
    <div class="step-labels d-flex justify-content-between w-50 mx-auto mb-4">
        <div>Step 1</div>
        <div>Step 2</div>
        <div>Step 3</div>
    </div>
    <div class="text-center mb-4">
            <img src="{{ asset('storage/uploads/finish.png')}}" alt="Report Submitted" style="height:100px;">
            <p class="mt-3">Thank you for your submission.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ReportID</th>
                        <th>Provider</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($report))
                    <tr>
                        <td>#{{ $report->report_id }}</td>
                        <td>{{ $report->reporter_email }}</td>
                        <td>{{ $report->reported_at ? \Carbon\Carbon::parse($report->reported_at)->format('d/m/Y') : '' }}</td>
                        <td>{{ $report->reported_at ? \Carbon\Carbon::parse($report->reported_at)->format('H:i') : '' }}</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>
                            <button class="btn btn-link"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-link"><i class="bi bi-printer"></i></button>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="6" class="text-center">No report found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
</div>

@endsection 