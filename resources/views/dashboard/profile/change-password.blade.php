@extends('dashboard.layouts.app')

@section('title')
    @lang('Change Password')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('dashboard.profile.index') }}">@lang('Profile Page')</a></li>
    <li>/</li>
    <li>@lang('Change Password')</li>
@endsection

@section('content')
    @include('dashboard.profile.menu')
    <form action="{{ route('dashboard.profile.change-passwords.update') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-md-12 mb-7">
                    <label class="required">@lang('Current Password')</label>
                    <input name="currentPassword" type="password" class="form-control mt-3 @error('currentPassword') is-invalid @enderror" />
                    @error('currentPassword')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-7">
                    <label class="required">@lang('New Password')</label>
                    <input name="newPassword" type="password" class="form-control mt-3 @error('newPassword') is-invalid @enderror" />
                    @error('newPassword')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-7">
                    <label class="required">@lang('Confirm New Password')</label>
                    <input name="newPassword_confirmation" type="password" class="form-control mt-3 @error('newPassword_confirmation') is-invalid @enderror" />
                    @error('newPassword_confirmation')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success w-100 w-lg-25">
                <span class="indicator-label">@lang('Update')</span>
                <span class="indicator-progress">@lang('Please Wait ...') <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
@endsection

@push('js')
    <script>
        // Menu
        $('#menuChangePassword').addClass('active');
        $('#profileChangePassword').addClass('active border-success');
    </script>
@endpush
