@extends('dashboard.layouts.app')

@section('title')
    @lang('Roles')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.roles.index') }}">@lang('Roles')</a></li>
    <li>/</li>
    <li>@lang('Show')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.roles.index') }}" class="btn btn-success">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale()== 'ar' ? 'right' : 'left' }}"></i>
        @lang('Roles')
    </a>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-row-bordered gy-5 gs-7 border table-rounded mb-0">
                    <tbody>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <tr>
                                <th class="align-middle text-nowrap py-7" width="30%">@lang('Name') ( <span class="text-muted">{{ $properties['native'] }}</span> )</th>
                                <td class="align-middle">{{ $role->getTranslation('name', $localeCode) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Permissions')</th>
                            <td>
                                @foreach ($permissions['permissionGroups'] as $title => $permissionGroup)
                                    <div class="row justify-content-center p-7 px-2 px-md-7 pb-0 fieldset border rounded mb-7">
                                        <div class="col-md-12 mb-7">
                                            <span class="bg-gray-200 px-6 py-3 rounded d-flex">@lang($title)</span>
                                        </div>
                                        @foreach ($permissionGroup as $title => $permission)
                                            <div class="col-md-6 col-xl-4 mb-7 ">
                                                <div class="card h-100 border">
                                                    <div class="card-header">
                                                        <div class="card-title w-100">
                                                            <div class="d-flex justify-content-between align-items-center w-100">@lang(Str::plural(is_array($permission) ? $title : $permission))</div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body d-flex flex-column pb-4">
                                                        @if (is_array($permission))
                                                            @foreach ($permission as $singlePermission)
                                                                <div class="d-flex justify-content-start align-items-center gap-3 mb-3">
                                                                    @if (in_array(
                                                                            $singlePermission,
                                                                            $role->permissions()->pluck('name')->toArray()))
                                                                        <i class="bi bi-check-circle text-success"></i>
                                                                    @else
                                                                        <i class="bi bi-x-circle text-danger"></i>
                                                                    @endif
                                                                    @lang($singlePermission)
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            @foreach ($permissions['permissionMaps'] as $permissionMap)
                                                                <div class="d-flex justify-content-start align-items-center gap-3 mb-3">
                                                                    @if (in_array(
                                                                            $permissionMap . ' ' . $permission,
                                                                            $role->permissions()->pluck('name')->toArray()))
                                                                        <i class="bi bi-check-circle text-success"></i>
                                                                    @else
                                                                        <i class="bi bi-x-circle text-danger"></i>
                                                                    @endif
                                                                    @lang($permissionMap . ' ' . $permission)
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Status')</th>
                            <td class="align-middle">
                                @if ($role->active == 1)
                                    <span class="badge badge-light-success fw-normal px-4 py-2 fs-7">@lang('Active')</span>
                                @elseif ($role->active == 0)
                                    <span class="badge badge-light-danger fw-normal px-4 py-2 fs-7">@lang('Inactive')</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Created At')</th>
                            <td class="align-middle">{!! dateTableFormat($role->created_at, '<br />', true, true) !!}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Updated At')</th>
                            <td class="align-middle">{!! dateTableFormat($role->updated_at, '<br />', true, true) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
