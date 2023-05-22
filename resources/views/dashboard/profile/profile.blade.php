@extends('dashboard.layouts.app')

@section('title')
    @lang('Profile Page')
@endsection

@section('breadcrumb')
    <li>@lang('Profile Page')</li>
@endsection

@section('content')
    @include('dashboard.profile.menu')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-row-bordered gy-5 gs-7 border table-rounded mb-0">
                    <tbody>
                        <tr>
                            <th class="align-middle py-7" width="30%">
                                @lang('Name')
                            </th>
                            <td class="align-middle">
                                {{ auth()->user()->name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle py-7" width="30%">
                                @lang('Phone')
                            </th>
                            <td class="align-middle">
                                {{ auth()->user()->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle py-7" width="30%">
                                @lang('Status')
                            </th>
                            <td class="align-middle">
                                @if (auth()->user()->active == 1)
                                    <span class="badge badge-light-success">@lang('Active')</span>
                                @elseif (auth()->user()->active == 0)
                                    <span class="badge badge-light-danger">@lang('Inactive')</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle py-7" width="30%">
                                @lang('Created At')
                            </th>
                            <td class="align-middle">
                                {!! dateTableFormat(auth()->user()->created_at, '<br/>', true, true) !!}
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle py-7" width="30%">
                                @lang('Updated At')
                            </th>
                            <td class="align-middle">
                                {!! dateTableFormat(auth()->user()->updated_at, '<br/>', true, true) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Menu
        $('#menuProfilePage').addClass('active');
        $('#profileProfilePage').addClass('active border-success');
    </script>
@endpush
