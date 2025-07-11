@extends('layouts.app')
@section('title', __('messages.crime_report_step1'))
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white px-0">
                <li class="breadcrumb-item"><a href="/">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item">{{ __('messages.report') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.step1') }}</li>

            </ol>
        </nav>
        <h3 class="text-center fw-bold mb-4 ">{{ __('messages.crime_report') }}</h3>
        <div class="d-flex justify-content-center mb-4">
            <div class="stepper d-flex justify-content-between w-50">
                <div class="step active">1</div>
                <div class="step-line"></div>
                <div class="step">2</div>
                <div class="step-line"></div>
                <div class="step">3</div>
            </div>
        </div>
        <div class="step-labels d-flex justify-content-between w-50 mx-auto mb-4">
            <div>{{ __('messages.step1') }}</div>
            <div>{{ __('messages.step2') }}</div>
            <div>{{ __('messages.step3') }}</div>
        </div>
        <form method="POST" action="{{ route('report.postStep1') }}">
            @csrf
            <div class="card p-4 mx-auto " style="max-width:950px; border: 0.5px solid #ffffff;">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1 border-top" style="height:1px;"></div>
                    <h3 class="fw-bold text-center fs-2 mx-3 mb-1">{{ __('messages.reporter_information') }}</h3>
                    <div class="flex-grow-1 border-top" style="height:1px;"></div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.full_name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="reporter_fullname" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="reporter_email" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.phone_number') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="reporter_phonenumber" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.address') }}</label>
                        <input type="text" class="form-control" name="case_location">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.relationship_to_incident') }} <span
                            class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_report" id="victim" value="Victim"
                            required>
                        <label class="form-check-label" for="victim">{{ __('messages.victim') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_report" id="witness" value="Witness">
                        <label class="form-check-label" for="witness">{{ __('messages.witness') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_report" id="offender" value="Offender">
                        <label class="form-check-label" for="offender">{{ __('messages.offender') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_report" id="anonymous" value="Anonymous">
                        <label class="form-check-label" for="anonymous">{{ __('messages.anonymous') }}</label>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" style="width: 150px;" class="btn btn-dark">{{ __('messages.next') }}</button>
                </div>
            </div>
        </form>
    </div>
    <style>

    </style>
@endsection
