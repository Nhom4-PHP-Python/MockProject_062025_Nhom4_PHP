@extends('layouts.app.app')
@section('title', __('messages.nypd_crime_report_home'))
@section('content')
    <div class="container mt-4">
        <div id="mainCarousel" class="carousel slide custom-carousel mb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="{{ __('messages.slide_1') }}"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"
                    aria-label="{{ __('messages.slide_2') }}"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"
                    aria-label="{{ __('messages.slide_3') }}"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/uploads/slide1.jpg') }}" class="d-block w-100"
                        alt="{{ __('messages.slide_1') }}">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/uploads/slide2.jpg') }}" class="d-block w-100"
                        alt="{{ __('messages.slide_2') }}">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/uploads/slide3.jpg') }}" class="d-block w-100"
                        alt="{{ __('messages.slide_3') }}">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('messages.previous') }}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('messages.next') }}</span>
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center fw-bold mb-4 mt-4 fs-2">{{ __('messages.how_you_can_help') }}</h2>
                <div class="row text-center mb-4">
                    <div class="col-md-4 mb-3">
                        <i class="bi bi-chat-dots" style="font-size: 2.5rem;"></i>
                        <div class="fw-bold">{{ __('messages.tell_us_what_happened') }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="bi bi-people" style="font-size: 2.5rem;"></i>
                        <div class="fw-bold">{{ __('messages.your_contribution_is_our_mission') }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="bi bi-shield-lock" style="font-size: 2.5rem;"></i>
                        <div class="fw-bold">{{ __('messages.protect_yourself_and_others') }}</div>
                    </div>
                </div>
                <div class="text-center mb-5">
                    <a href="{{ route('sc_002') }}" class="btn btn-primary btn-lg"
                        style="background-color: #0a41b9;">{{ __('messages.file_a_report') }}</a>
                </div>
                <div class="flex-grow-1 border-top w-50 mx-auto mb-5" style="height:1px;"></div>
                <h3 class="fw-bold mb-5 text-center fs-2">{{ __('messages.programs_and_resources') }}</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 text-left">
                            <img src="{{ asset('storage/uploads/crime-stats.png') }}"
                                alt="{{ __('messages.compstat_and_crime_stats') }}" class="img-fluid"
                                style="width: 100%; height: 400px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title mt-3">{{ __('messages.compstat_and_crime_stats') }}</h5>
                                <p class="card-text small">{{ __('messages.compstat_and_crime_stats_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 text-left">
                            <img src="{{ asset('storage/uploads/Body_worn_camera.webp') }}"
                                alt="{{ __('messages.body_worn_cameras') }}" class="img-fluid"
                                style="width: 100%; height: 400px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title mt-3">{{ __('messages.body_worn_cameras') }}</h5>
                                <p class="card-text small">{{ __('messages.body_worn_cameras_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 text-left">
                            <img src="{{ asset('storage/uploads/police_department.jpg') }}"
                                alt="{{ __('messages.help_is_available') }}" class="img-fluid"
                                style="width: 100%; height: 400px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title mt-3">{{ __('messages.help_is_available') }}</h5>
                                <p class="card-text small">{{ __('messages.help_is_available_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
