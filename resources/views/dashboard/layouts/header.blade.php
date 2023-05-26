<div id="kt_app_header" class="app-header">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">

        <!-- Sidebar Mobile Toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-danger w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>

        <!-- Mobile Logo -->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('dashboard.index') }}" class="d-lg-none">
                <img alt="{{ env('APP_NAME') }}" src="{{ asset(Setting::get('logoBlack')) }}" class="mh-20px" />
            </a>
        </div>

        <!-- Header Wrapper -->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">

            <!-- Menu Wrapper -->
            <div class="app-header-menu app-header-mobile-drawer align-items-center" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div id="kt_app_header_menu" data-kt-menu="true">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center align-items-start my-0">
                            <span class="text-dark fw-bold fs-3">@yield('title')</span>
                            @if (Route::currentRouteName() != 'dashboard.index')
                                <ol class="breadcrumb text-muted fs-6 fw-normal d-flex gap-3 fs-8 mt-2">
                                    <li><a href="{{ route('dashboard.index') }}">@lang('Home Page')</a></li>
                                    <li>/</li>
                                    @yield('breadcrumb')
                                </ol>
                            @endif
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Navbar -->
            <div class="app-navbar flex-shrink-0 gap-3">

                <!-- Theme Mode -->
                <div class="app-navbar-item">
                    <a class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-danger w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                        <i class="theme-light-show bi bi-sun fs-3"></i>
                        <i class="theme-dark-show bi bi-moon-stars fs-3"></i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color menu-hover-title-danger fw-semibold py-4 fs-base w-175px" data-kt-menu="true" data-kt-element="theme-mode-menu">
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

                <!-- Language -->
                <div class="app-navbar-item">
                    <a class="btn btn-icon btn-custom btn-active-light btn-active-color-danger w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                        <img class="w-20px h-20px rounded-1" src="{{ asset('assets/media/flags/' . LaravelLocalization::getCurrentLocale(). '.png') }}" alt="{{ LaravelLocalization::getCurrentLocaleNative() }}" />
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-175px" data-kt-menu="true">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="menu-item px-3 my-0">
                                <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="menu-link px-3 py-2 @if (LaravelLocalization::getCurrentLocale() == $localeCode) active @endif">
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

                <!-- User Menu -->
                <div class="app-navbar-item" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                        <img src="{{ auth()->user()->profile }}" alt="{{ auth()->user()->name }}" class="rounded-circle" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content d-flex flex-column align-items-center px-3">
                                <div class="symbol symbol-100px">
                                    <img src="{{ auth()->user()->profile }}" alt="{{ auth()->user()->name }}" class="rounded-circle" />
                                </div>
                                <div class="d-flex flex-column align-items-center mt-3 w-100">
                                    <span class="fw-bold fs-5">
                                        {{ auth()->user()->name }}
                                    </span>
                                    <span class="text-muted fs-7">
                                        {{ auth()->user()->email }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="separator mt-2 mb-4"></div>

                        <div class="menu-item px-5">
                            <a id="menuProfilePage" href="{{ route('dashboard.profile.index') }}" class="menu-link px-5">
                                <span class="menu-icon me-3">
                                    <i class="bi bi-person-rolodex"></i>
                                </span>
                                @lang('Profile Page')
                            </a>
                        </div>

                        <div class="menu-item px-5">
                            <a id="menuChangePassword" href="{{ route('dashboard.profile.change-passwords.index') }}" class="menu-link px-5">
                                <span class="menu-icon me-3">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                @lang('Change Password')
                            </a>
                        </div>

                        <div class="menu-item px-5">
                            <a onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="menu-link px-5">
                                <span class="menu-icon me-3">
                                    <i class="bi bi-box-arrow-left"></i>
                                </span>
                                @lang('Logout')
                            </a>
                            <form id="logoutForm" action="{{ route('dashboard.profile.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
