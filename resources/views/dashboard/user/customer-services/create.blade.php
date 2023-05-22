@extends('dashboard.layouts.app')

@section('title')
    @lang('Customer Services')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.customer-services.index') }}">@lang('Customer Services')</a></li>
    <li>/</li>
    <li>@lang('Create')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.customer-services.index') }}" class="btn btn-success">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale()== 'ar' ? 'right' : 'left' }}"></i>
        @lang('Customer Services')
    </a>
@endsection

@section('content')
    <form action="{{ route('dashboard.customer-services.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
        <div class="card-body pb-0">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12 mb-7 d-flex justify-content-center align-items-center flex-column">
                    <label>@lang('Profile Image')</label>
                    <div class="image-input d-flex flex-column">
                        <a data-fslightbox="profile" href="{{ asset('assets/default.png') }}" class="symbol symbol-150px my-3 bg-white border border-5 border-white rounded-4 shadow-sm overflow-hidden">
                            <img src="{{ asset('assets/default.png') }}">
                        </a>
                        <label class="btn btn-light btn-active-color-success btn-icon w-100 position-relative translate-y-0 @error('profile') border border-danger @enderror" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-dismiss="click" title="@lang('Select Image')">
                            <i class="bi bi-upload"></i>
                            <input name="profile" type="file" accept=".png, .jpg, .jpeg, .gif, .webp" class="d-none" />
                        </label>
                    </div>
                    @error('profile')
                        <span class="invalid-feedback justify-content-center mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-7">
                    <label class="required">@lang('Name')</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control mt-3 @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-7">
                    <label class="required">@lang('Phone')</label>
                    <input name="phone" value="{{ old('phone') }}" type="text" class="form-control mt-3 @error('phone') is-invalid @enderror">
                    @error('phone')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-7" data-kt-password-meter="true">
                    <label class="required">@lang('Password')</label>
                    <div class="position-relative my-3">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 @error('password') me-5 @enderror" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                    </div>
                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>
                    <div class="text-muted text-center">@lang('Use 8 Or More Characters With a Mix Of Letters, Numbers & Symbols')</div>
                    @error('password')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-7" data-kt-password-meter="true">
                    <label class="required">@lang('Password Confirmation')</label>
                    <div class="position-relative my-3">
                        <input name="password_confirmation" type="password" class="form-control" autocomplete="off" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                    </div>
                    <div class="d-none" data-kt-password-meter-control="highlight">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>
                </div>
                <div class="col-md-12 mb-7">
                    <label class="required">@lang('Roles')</label>
                    <select name="role" data-control="select2" data-placeholder="&nbsp;" class="form-select mt-3 @error('role') is-invalid @enderror">
                        <option></option>
                        @foreach ($roles as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success w-100 w-lg-25">
                <span class="indicator-label">@lang('Create')</span>
                <span class="indicator-progress">@lang('Please Wait ...') <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
@endsection

@push('js')
    @include('dashboard.layouts.packages.files')
    <script>
        // IMAGE
        $('[name="profile"]').change(function() {
            filePreview(this);
        });

        // SELECT
        $('[name="role"]').select2().val('{{ old('role') }}');
    </script>
@endpush