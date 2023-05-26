@extends('dashboard.layouts.app')

@section('title')
    @lang('Users')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.users.index') }}">@lang('Users')</a></li>
    <li>/</li>
    <li>@lang('Show')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.users.index') }}" class="btn btn-danger">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale()== 'ar' ? 'right' : 'left' }}"></i>
        @lang('Users')
    </a>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-row-bordered gy-5 gs-7 border table-rounded mb-0">
                    <tbody>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Profile Image')</th>
                            <td class="align-middle">
                                <a data-fslightbox href="{{ $user->profile }}" class="symbol symbol-150px my-3 bg-white border border-5 border-white rounded-4 shadow-sm overflow-hidden">
                                    <img src="{{ $user->profile }}">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Name')</th>
                            <td class="align-middle">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Email Address')</th>
                            <td class="align-middle">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Status')</th>
                            <td class="align-middle">
                                @if ($user->active == 1)
                                    <span class="badge badge-light-success fw-normal px-4 py-2 fs-7">@lang('Active')</span>
                                @elseif ($user->active == 0)
                                    <span class="badge badge-light-danger fw-normal px-4 py-2 fs-7">@lang('Inactive')</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Created At')</th>
                            <td class="align-middle">{!! dateTableFormat($user->created_at, '<br />', true, true) !!}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Updated At')</th>
                            <td class="align-middle">{!! dateTableFormat($user->updated_at, '<br />', true, true) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
