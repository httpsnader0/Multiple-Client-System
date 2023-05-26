@extends('dashboard.layouts.auth')

@section('title')
    @lang('Client Register')
@endsection

@section('content')
    <form action="{{ route('dashboard.client-register.store') }}" method="POST" class="row justify-content-center">
        @csrf
        <div class="col-md-12 text-center mb-10">
            <h1 class="fw-bolder text-danger mb-3 fs-3x">@lang('Client Register')</h1>
            <div class="text-gray-500 fw-semibold fs-6">@lang('Fill Up The Form')</div>
        </div>
        <input type="hidden" name="type" value="Client" />
        <div class="col-md-12 mb-7">
            <input name="name" placeholder="@lang('Name')" type="text" class="form-control bg-transparent h-60px @error('name') is-invalid @enderror" />
            @error('name')
                <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-7">
            <input name="email" placeholder="@lang('Email Address')" type="text" class="form-control bg-transparent h-60px @error('email') is-invalid @enderror" />
            @error('email')
                <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-7" data-kt-password-meter="true">
            <div class="position-relative my-3">
                <input name="password" placeholder="@lang('Password')" type="password" class="form-control bg-transparent h-60px @error('password') is-invalid @enderror" autocomplete="off" />
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 @error('password') me-5 @enderror" data-kt-password-meter-control="visibility">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
            </div>
            @error('password')
                <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-7" data-kt-password-meter="true">
            <div class="position-relative my-3">
                <input name="password_confirmation" placeholder="@lang('Password Confirmation')" type="password" class="form-control bg-transparent h-60px @error('password_confirmation') is-invalid @enderror" autocomplete="off" />
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 @error('password_confirmation') me-5 @enderror" data-kt-password-meter-control="visibility">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
            </div>
            @error('password_confirmation')
                <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-7">
            <button type="submit" class="btn btn-danger w-100">
                <span class="indicator-label">@lang('Register')</span>
                <span class="indicator-progress">@lang('Please Wait ...') <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <div class="col-md-6 mb-7">
            <a href="{{ route('dashboard.login') }}" class="btn btn-secondary w-100">@lang('Login')</a>
        </div>
        <div class="col-md-6 mb-7">
            <a href="{{ route('dashboard.user-register.index') }}" class="btn btn-secondary w-100">@lang('User Register')</a>
        </div>
    </form>
@endsection
