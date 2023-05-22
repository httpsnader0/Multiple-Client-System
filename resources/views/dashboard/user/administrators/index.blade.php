@extends('dashboard.layouts.app')

@section('title')
    @lang('Administrators')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li>@lang('Administrators')</li>
@endsection

@section('actions')
    @include('dashboard.layouts.packages.livewire.filter')
    <a href="{{ route('dashboard.administrators.create') }}" class="btn btn-success d-flex align-items-center gap-2 w-100 w-md-auto justify-content-center order-1 order-md-3">
        <i class="bi bi-plus-circle"></i>
        @lang('Create') @lang('Administrators')
    </a>
@endsection

@section('content')
    @include('dashboard.user.administrators.filters')
    <div class="card shadow-sm">
        <div class="card-body">
            @livewire('dashboard.user.administrator-table')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    @include('dashboard.layouts.packages.livewire.loading')
@endpush
