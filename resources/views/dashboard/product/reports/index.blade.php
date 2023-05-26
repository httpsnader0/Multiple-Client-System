@extends('dashboard.layouts.app')

@section('title')
    @lang('Reports')
@endsection

@section('breadcrumb')
    <li>@lang('Reports')</li>
    <li>/</li>
    <li>@lang('Reports')</li>
@endsection

@section('actions')
    @include('dashboard.layouts.packages.livewire.filter')
@endsection

@section('content')
    @include('dashboard.product.reports.filters')
    <div class="card shadow-sm">
        <div class="card-body">
            @livewire('dashboard.product.report-table')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    @include('dashboard.layouts.packages.livewire.loading')
@endpush
