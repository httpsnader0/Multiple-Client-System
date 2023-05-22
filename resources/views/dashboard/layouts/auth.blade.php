<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" style="direction: {{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>

    <!-- TITLE -->
    <title>
        @if (trim($__env->yieldContent('title')))
            @yield('title') -
        @endif {{ env('APP_NAME') }}
    </title>

    <!-- META -->
    <link rel="shortcut icon" href="{{ asset(Setting::get('icon')) }}" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta charset="utf-8" />
    <meta Content-Type="charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:locale" content="" />
    <meta property="og:type" content="" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('css')

</head>

<body class="bg-gray-100" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on">

    <!-- Theme Mode -->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>

    <!-- Loading -->
    <div class="page-loader flex-column">
        <img alt="{{ env('APP_NAME') }}" class="theme-light-show mh-100px m opacity-50" src="{{ asset(Setting::get('logoBlack')) }}" />
        <img alt="{{ env('APP_NAME') }}" class="theme-dark-show mh-100px opacity-50" src="{{ asset(Setting::get('logoWhite')) }}" />
        <div class="d-flex flex-column align-items-center mt-15">
            <span class="spinner-border text-success" role="status"></span>
            <span class="text-muted fs-6 fw-semibold ms-5 mt-5">@lang('Loading ...')</span>
        </div>
    </div>

    <!-- Main -->
    <div class="d-flex justify-content-center align-items-center w-100 h-100" id="kt_app_root">

        <div class="card w-75 w-xl-50 shadow-lg">

            <div class="card-body">

                <div class="d-flex justify-content-center justify-content-lg-end gap-3 w-100 mb-10">

                    <!-- Theme Mode -->
                    <div>
                        <a class="btn btn-icon btn-light btn-icon-muted btn-active-light btn-active-color-success w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                            <i class="theme-light-show bi bi-sun fs-3"></i>
                            <i class="theme-dark-show bi bi-moon-stars fs-3"></i>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-175px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                            <div class="menu-item px-3 my-0">
                                <a class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="bi bi-sun"></i>
                                    </span>
                                    <span class="menu-title">@lang('Light')</span>
                                </a>
                            </div>
                            <div class="menu-item px-3 my-0">
                                <a class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="bi bi-moon-stars"></i>
                                    </span>
                                    <span class="menu-title">@lang('Dark')</span>
                                </a>
                            </div>
                            <div class="menu-item px-3 my-0">
                                <a class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="bi bi-laptop"></i>
                                    </span>
                                    <span class="menu-title">@lang('System')</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- LANGUAGE -->
                    <div>
                        <a class="btn btn-icon btn-light btn-active-light btn-active-color-success w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                            <img class="w-20px h-20px rounded-1" src="{{ asset('assets/media/flags/' . LaravelLocalization::getCurrentLocale() . '.png') }}" alt="{{ LaravelLocalization::getCurrentLocaleNative() }}" />
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-175px" data-kt-menu="true">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="menu-item px-3 my-0">
                                    <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="menu-link @if (LaravelLocalization::getCurrentLocale() == $localeCode) active @endif">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <img class="w-20px h-20px rounded-1" src="{{ asset($properties['flag']) }}" alt="{{ $properties['native'] }}">
                                        </span>
                                        <span class="menu-title">
                                            {{ $properties['native'] }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-100">
                        @yield('content')
                    </div>
                </div>

                <div class="app-container container-fluid d-flex flex-column align-items-center p-5 flex-xl-row justify-content-xl-between" style="direction: ltr">
                    <div class="order-1 d-flex align-items-center mb-2">
                        <a href="{{ route('dashboard.index') }}">
                            <img alt="{{ env('APP_NAME') }}" src="{{ asset(Setting::get('icon')) }}" class="mh-20px" />
                        </a>
                        <span class="mx-5 fs-7 text-gray-600 pt-1">
                            Multiple Client System © 2023
                        </span>
                    </div>
                    <div class="order-2 fs-7mb-5 mb-md-0 text-muted">
                        Made With
                        <span class="svg-icon svg-icon-danger svg-icon-4 mx-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        By
                        <a href="https://fb.com/httpsnader0" target="_blank" class="mx-1">Mohamed Nader</a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @include('dashboard.layouts.scripts.notify')
    @stack('js')

</body>

</html>
