@extends('dashboard.layouts.app')

@section('title')
    @lang('Roles')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.roles.index') }}">@lang('Roles')</a></li>
    <li>/</li>
    <li>@lang('Edit')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.roles.index') }}" class="btn btn-success">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale()== 'ar' ? 'right' : 'left' }}"></i>
        @lang('Roles')
    </a>
@endsection

@section('content')
    <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
        <div class="card-body pb-0">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="accordion row justify-content-center" id="languageAccordion">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="col-md-6 mb-7">
                                <div class="accordion-item rounded">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button rounded rounded-bottom-0 gap-3 fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $localeCode }}" aria-expanded="true">
                                            <div class="symbol symbol-20px">
                                                <img src="{{ asset($properties['flag']) }}" alt="{{ $properties['native'] }}" />
                                            </div>
                                            {{ $properties['native'] }}
                                        </button>
                                    </h2>
                                    <div id="{{ $localeCode }}" class="accordion-collapse collapse show" data-bs-parent="#languageAccordion">
                                        <div class="accordion-body px-7 pt-7 pb-0">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 mb-7">
                                                    <label class="required">@lang('Name')</label>
                                                    <input name="name[{{ $localeCode }}]" value="{{ old('name.' . $localeCode, $role->getTranslation('name', $localeCode)) }}" type="text" class="form-control mt-3 @error('name.' . $localeCode) is-invalid @enderror">
                                                    @error('name.' . $localeCode)
                                                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 mb-7">
                    <div class="row justify-content-center permissionBox border rounded px-7 pt-7">
                        <div class="col-md-10 mb-7">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="bg-gray-200 px-6 py-3 rounded">@lang('Permissions')</span>
                                <label class="form-check form-check-sm form-check-custom form-check-solid fs-7 text-muted">
                                    <input class="form-check-input h-15px w-15px selectAll cursor-pointer" type="checkbox">
                                    <span class="form-check-label cursor-pointer">@lang('Select All')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 permissionContent">
                            @foreach ($permissions['permissionGroups'] as $title => $permissionGroup)
                                <div class="row justify-content-center p-7 pb-0 fieldset border rounded mb-7">
                                    <div class="col-md-12 mb-7">
                                        <span class="bg-gray-200 px-6 py-3 rounded d-flex">@lang($title)</span>
                                    </div>
                                    @foreach ($permissionGroup as $title => $permission)
                                        <div class="col-md-6 col-xl-4 mb-7 permissionCard">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-header">
                                                    <div class="card-title w-100">
                                                        <div class="d-flex justify-content-between align-items-center flex-wrap w-100">
                                                            @lang(Str::plural(is_array($permission) ? $title : $permission))
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid fs-7 text-muted py-3">
                                                                <input class="form-check-input h-15px w-15px cardSelectAll cursor-pointer" type="checkbox">
                                                                <span class="form-check-label cursor-pointer">@lang('Select All')</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body d-flex flex-column pb-4">
                                                    @if (is_array($permission))
                                                        @foreach ($permission as $singlePermission)
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid fs-7 text-muted mb-3">
                                                                <input name="permissions[{{ $singlePermission }}]" value="{{ $singlePermission }}" class="form-check-input h-15px w-15px permissionCheck cursor-pointer" type="checkbox" @if (old('permissions.' . $singlePermission) ||
                                                                        (in_array(
                                                                            $singlePermission,
                                                                            $role->permissions()->pluck('name')->toArray()) &&
                                                                            !old('_token'))) checked @endif>
                                                                <span class="form-check-label cursor-pointer">@lang($singlePermission)</span>
                                                            </label>
                                                        @endforeach
                                                    @else
                                                        @foreach ($permissions['permissionMaps'] as $permissionMap)
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid fs-7 text-muted mb-3">
                                                                <input name="permissions[{{ $permissionMap . ' ' . $permission }}]" value="{{ $permissionMap . ' ' . $permission }}" class="form-check-input h-15px w-15px permissionCheck cursor-pointer" type="checkbox" @if (old('permissions.' . $permissionMap . ' ' . $permission) ||
                                                                        (in_array(
                                                                            $permissionMap . ' ' . $permission,
                                                                            $role->permissions()->pluck('name')->toArray()) &&
                                                                            !old('_token'))) checked @endif>
                                                                <span class="form-check-label cursor-pointer">@lang($permissionMap . ' ' . $permission)</span>
                                                            </label>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
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
        // PERMISSIONS
        $(document).on('change', '.selectAll', function() {
            $('.permissionCheck').prop('checked', this.checked);
            $('.cardSelectAll').prop('checked', this.checked);
        });
        $(document).on('change', '.cardSelectAll', function() {
            $(this).closest('.card').find('input:checkbox').prop('checked', this.checked);
            $('.selectAll').prop('checked', $(this).closest('.permissionContent').find('.cardSelectAll:checkbox:not(:checked)').length == 0 ? true : false);
        });
        $(document).on('change', '.permissionCheck', function() {
            $(this).closest('.card').find('.cardSelectAll').prop('checked', $(this).closest('.card').find('.permissionCheck:checkbox:not(:checked)').length == 0 ? true : false);
            $('#selectAll').prop('checked', $(this).closest('.permissionContent').find('.cardSelectAll:checkbox:not(:checked)').length == 0 ? true : false);
        });
        $(function() {
            $('.permissionCard').each(function(i, obj) {
                var checkCounts = 0;
                $(this).find('input:checkbox:not(.cardSelectAll)').each(function(i, obj) {
                    if ($(this).is(':checked')) {
                        checkCounts++;
                    }
                });
                if ($(this).find('input:checkbox:not(.cardSelectAll)').length == checkCounts) {
                    $(this).find('.cardSelectAll').prop('checked', true);
                }
            });
            var checkAllCounts = 0;
            $('.permissionBox').find('input:checkbox:not(.cardSelectAll):not(.selectAll)').each(function(i, obj) {
                if ($(this).is(':checked')) {
                    checkAllCounts++;
                }
            });
            if ($('.permissionBox').find('input:checkbox:not(.cardSelectAll):not(.selectAll)').length == checkAllCounts) {
                $('.permissionBox').find('.selectAll').prop('checked', true);
            }
        });
    </script>
@endpush
