@extends('dashboard.layouts.app')

@section('title')
    @lang('Clients')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.clients.index') }}">@lang('Clients')</a></li>
    <li>/</li>
    <li>@lang('Show')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.clients.index') }}" class="btn btn-success">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale()== 'ar' ? 'right' : 'left' }}"></i>
        @lang('Clients')
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
                                <a data-fslightbox href="{{ $client->profile }}" class="symbol symbol-150px my-3 bg-white border border-5 border-white rounded-4 shadow-sm overflow-hidden">
                                    <img src="{{ $client->profile }}">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Name')</th>
                            <td class="align-middle">{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Phone')</th>
                            <td class="align-middle">{{ $client->phone }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Status')</th>
                            <td class="align-middle">
                                @if ($client->active == 1)
                                    <span class="badge badge-light-success fw-normal px-4 py-2 fs-7">@lang('Active')</span>
                                @elseif ($client->active == 0)
                                    <span class="badge badge-light-danger fw-normal px-4 py-2 fs-7">@lang('Inactive')</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Created At')</th>
                            <td class="align-middle">{!! dateTableFormat($client->created_at, '<br />', true, true) !!}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Updated At')</th>
                            <td class="align-middle">{!! dateTableFormat($client->updated_at, '<br />', true, true) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
