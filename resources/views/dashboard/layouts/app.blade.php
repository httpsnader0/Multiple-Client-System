<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" style="direction: {{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>

    @include('dashboard.layouts.head')

</head>

<body id="kt_app_body" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

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

    <!-- Root -->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">

        <!-- Page -->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <!-- Header -->
            @include('dashboard.layouts.header')

            <!-- Wrapper -->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                <!-- Sidebar -->
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

                    <!-- Logo -->
                    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">

                        <!-- Logo Image -->
                        <a href="{{ route('dashboard.index') }}">
                            <img alt="{{ env('APP_NAME') }}" src="{{ asset(Setting::get('logoWhite')) }}" class="mh-35px app-sidebar-logo-default" />
                            <img alt="{{ env('APP_NAME') }}" src="{{ asset(Setting::get('logoWhite')) }}" class="mh-15px app-sidebar-logo-minimize" />
                        </a>

                        <!-- Sidebar Toggle -->
                        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-success body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                            <span class="svg-icon svg-icon-2 rotate-180">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                                </svg>
                            </span>
                        </div>

                    </div>

                    <!-- Sidebar Menu -->
                    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                            <div class="menu menu-column menu-rounded menu-sub-indention px-3 fs-5" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                                @include('dashboard.layouts.menu')
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Main -->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <!-- Content Wrapper -->
                    <div class="d-flex flex-column flex-column-fluid">

                        <!-- Toolbar -->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex justify-content-end">
                                <div class="d-flex align-items-center flex-wrap gap-2 gap-lg-3">
                                    @yield('actions')
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                @yield('content')
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    @include('dashboard.layouts.footer')

                </div>

            </div>
        </div>
    </div>

    <!-- Scrolltop -->
    <div id="kt_scrolltop" class="scrolltop bg-success" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
            </svg>
        </span>
    </div>

    <!-- Javascript -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="{{ asset('assets/packages/lottie/lottie-player.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @include('dashboard.layouts.scripts.notify')
    <script src="{{ asset('assets/packages/pusher/pusher.min.js') }}"></script>
    @include('dashboard.layouts.scripts.notifications')
    @stack('js')

</body>

</html>
