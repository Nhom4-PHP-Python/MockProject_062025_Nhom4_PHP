@extends('layouts.app.app')
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
            <img src="{{ asset('storage/uploads/finish.png') }}" alt="Report Submitted" style="height:100px;">
            <p class="mt-4">Thank you for your submission.</p>
        </div>

    </div>

@endsection
