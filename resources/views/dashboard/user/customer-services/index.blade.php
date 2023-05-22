@extends('dashboard.layouts.app')

@section('title')
    @lang('Customer Services')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li>@lang('Customer Services')</li>
@endsection

@section('actions')
    @include('dashboard.layouts.packages.livewire.filter')
    <a href="{{ route('dashboard.customer-services.create') }}" class="btn btn-success d-flex align-items-center gap-2 w-100 w-md-auto justify-content-center order-1 order-md-3">
        <i class="bi bi-plus-circle"></i>
        @lang('Create') @lang('Customer Services')
    </a>
@endsection

@section('content')
    @include('dashboard.user.customer-services.filters')
    <div class="card shadow-sm">
        <div class="card-body">
            @livewire('dashboard.user.customer-service-table')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    @include('dashboard.layouts.packages.livewire.loading')
@endpush
