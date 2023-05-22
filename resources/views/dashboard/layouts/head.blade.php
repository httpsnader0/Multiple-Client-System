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
@if (LaravelLocalization::getCurrentLocale()== 'ar')
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
@else
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
@endif
<link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" type="text/css" />
@stack('css')
