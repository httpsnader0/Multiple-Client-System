@extends('dashboard.layouts.app')

@section('title')
    @lang('Clients')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li>@lang('Clients')</li>
@endsection

@section('actions')
    @include('dashboard.layouts.packages.livewire.filter')
@endsection

@section('content')
    @include('dashboard.user.clients.filters')
    <div class="card shadow-sm">
        <div class="card-body">
            @livewire('dashboard.user.client-table')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    @include('dashboard.layouts.packages.livewire.loading')
@endpush
