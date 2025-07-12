<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'NYC') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    <style>

    </style>
    @stack('styles')
</head>

<body>
    <div id="app">
        <!-- Top bar -->
        <div class="bg-dark text-white py-2">
            <div class="container-fluid px-2 px-md-3">
                <div class="row align-items-center g-0">
                    <!-- Logo NYC -->
                    <div
                        class="col-3 col-sm-4 col-md-2 d-flex justify-content-end align-items-center pe-1 pe-md-2 logo-nyc">
                        <span class="fw-bold fs-2 header-nyc-logo" style="margin-right: 5px;">NYC</span>
                    </div>
                    <!-- Title -->
                    <div
                        class="col-6 col-sm-4 col-md-8 d-flex justify-content-center justify-content-md-start align-items-center px-1">
                        <span
                            class="fw-semibold header-nyc-title text-center text-md-start">{{ __('messages.new_york_city') }}<br
                                class="d-block d-sm-none"> {{ __('messages.police_department') }}</span>
                    </div>
                    <!-- Language -->
                    <div
                        class="col-3 col-sm-4 col-md-2 d-flex justify-content-end justify-content-md-start align-items-center ps-1 language_select">
                        <div class="language-dropdown">
                            <button class="language-btn" type="button">
                                <span>
                                    @switch(app()->getLocale())
                                        @case('en')
                                            {{ __('messages.english') }}
                                        @break

                                        @case('vi')
                                            {{ __('messages.vietnamese') }}
                                        @break

                                        @case('zh')
                                            {{ __('messages.chinese') }}
                                        @break

                                        @case('es')
                                            {{ __('messages.spanish') }}
                                        @break

                                        @case('fr')
                                            {{ __('messages.french') }}
                                        @break

                                        @case('de')
                                            {{ __('messages.german') }}
                                        @break

                                        @case('ja')
                                            {{ __('messages.japanese') }}
                                        @break

                                        @case('ko')
                                            {{ __('messages.korean') }}
                                        @break

                                        @case('it')
                                            {{ __('messages.italian') }}
                                        @break

                                        @case('ru')
                                            {{ __('messages.russian') }}
                                        @break

                                        @default
                                            {{ __('messages.english') }}
                                    @endswitch
                                </span>
                                <i class="bi bi-globe ms-1"></i>
                            </button>
                            <div class="language-menu">
                                <a href="{{ route('lang.switch', 'en') }}"
                                    data-lang="en">{{ __('messages.english') }}</a>
                                <a href="{{ route('lang.switch', 'vi') }}"
                                    data-lang="vi">{{ __('messages.vietnamese') }}</a>
                                <a href="{{ route('lang.switch', 'zh') }}"
                                    data-lang="zh">{{ __('messages.chinese') }}</a>
                                <a href="{{ route('lang.switch', 'es') }}"
                                    data-lang="es">{{ __('messages.spanish') }}</a>
                                <a href="{{ route('lang.switch', 'fr') }}"
                                    data-lang="fr">{{ __('messages.french') }}</a>
                                <a href="{{ route('lang.switch', 'de') }}"
                                    data-lang="de">{{ __('messages.german') }}</a>
                                <a href="{{ route('lang.switch', 'ja') }}"
                                    data-lang="ja">{{ __('messages.japanese') }}</a>
                                <a href="{{ route('lang.switch', 'ko') }}"
                                    data-lang="ko">{{ __('messages.korean') }}</a>
                                <a href="{{ route('lang.switch', 'it') }}"
                                    data-lang="it">{{ __('messages.italian') }}</a>
                                <a href="{{ route('lang.switch', 'ru') }}"
                                    data-lang="ru">{{ __('messages.russian') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logo NYPD -->
        <div class="bg-white py-3 border-bottom">
            <div class="container d-flex justify-content-center align-items-center">
                <img class="logo-nypd-img" src="{{ asset('storage/uploads/logo_nyc.png') }}" alt="NYPD"
                    style="height:70px;">
                <span class="ms-3 fw-bold logo-nypd"
                    style="font-size:2.5rem; color:#0a41b9; font-family: 'Arial Black', Arial, sans-serif; letter-spacing: 0.05em;">NYPD</span>
            </div>
        </div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-6 custom-menu">
                        <li class="nav-item px-2"><a class="nav-link active fw-bold" style="color: #0a41b9"
                                href="/">{{ __('messages.home') }}</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-bold" style="color: black"
                                href="#">{{ __('messages.about') }}</a>
                        </li>
                        <li class="nav-item px-2"><a class="nav-link fw-bold" style="color: black"
                                href="#">{{ __('messages.bureaus') }}</a>
                        </li>
                        <li class="nav-item px-2"><a class="nav-link fw-bold" style="color: black"
                                href="#">{{ __('messages.services') }}</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-bold" style="color: black"
                                href="#">{{ __('messages.stats') }}</a>
                        </li>
                        <li class="nav-item px-2"><a class="nav-link fw-bold" style="color: black"
                                href="#">{{ __('messages.policies') }}</a></li>
                    </ul>
                    <form class="d-flex position-relative align-items-center search-form"
                        action="{{ route('search') }}" method="GET">
                        <img src="{{ asset('storage/uploads/search.png') }}" alt="Search"
                            style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; opacity: 0.7; cursor: pointer;"
                            onclick="document.querySelector('.search-form').submit();">
                        <input class="form-control border-0 pe-5" type="search" name="q"
                            placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('q') }}"
                            aria-label="Search" id="search-input"
                            style="min-width: 120px; padding-left: 35px; background-color: #ececec;">
                        <!-- Search suggestions dropdown -->
                        <div class="search-suggestions" id="search-suggestions" style="display: none;"></div>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <main class="container my-4">
            @yield('content')
        </main>
        <!-- Footer -->
        <footer class="footer mt-auto">
            <div class="container">
                <div class="row footer-row">
                    <div class="col-md-3">
                        <strong>{{ __('messages.directory_city_agencies') }}</strong><br>
                        {{ __('messages.notify_nyc') }}<br>
                        {{ __('messages.nyc_mobile_apps') }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('messages.contact_nyc_government') }}</strong><br>
                        {{ __('messages.city_store') }}<br>
                        {{ __('messages.maps') }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('messages.city_employees') }}</strong><br>
                        {{ __('messages.stay_connected') }}<br>
                        {{ __('messages.resident_toolkit') }}
                    </div>
                    <div class="col-md-3 text-md-start">
                        <form class="d-flex position-relative align-items-center" action="{{ route('search') }}"
                            method="GET">
                            <span class="fw-bold fs-4 header-nyc-logo" style="margin-right: 5px;"
                                id="nyc-logo">NYC</span>

                            <img src="{{ asset('storage/uploads/search.png') }}" alt="Search"
                                style="position: absolute; left: 60px; top: 7px; width: 20px; height: 20px; opacity: 0.7; cursor: pointer;"
                                id="search-footer" onclick="this.closest('form').submit();">
                            <input class="form-control border-0 pe-5" type="search" name="q"
                                placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('q') }}"
                                aria-label="Search"
                                style="min-width: 120px; padding-left: 30px; background-color: #ececec ">
                        </form>
                        <div>{{ __('messages.city_of_new_york') }}<br>
                            {{ __('messages.nyc_trademark') }}
                            <a href="#">{{ __('messages.privacy_policy') }}</a>. <a
                                href="#">{{ __('messages.terms_of_use') }}</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
    <script src="{{ asset('js/language-switcher.js') }}"></script>
</body>

</html>
