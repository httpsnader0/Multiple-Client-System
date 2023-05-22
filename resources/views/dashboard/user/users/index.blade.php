@extends('dashboard.layouts.app')

@section('title')
    @lang('Users')
@endsection

@section('breadcrumb')
    <li>@lang('Users')</li>
    <li>/</li>
    <li>@lang('Users')</li>
@endsection

@section('actions')
    @include('dashboard.layouts.packages.livewire.filter')
@endsection

@section('content')
    @include('dashboard.user.users.filters')
    <div class="card shadow-sm">
        <div class="card-body">
            @livewire('dashboard.user.user-table')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    @include('dashboard.layouts.packages.livewire.loading')
@endpush
