@extends('dashboard.layouts.app')

@section('title')
    @lang('Products')
@endsection

@section('breadcrumb')
    <li>@lang('Products')</li>
    <li>/</li>
    <li>@lang('Products')</li>
@endsection

@section('actions')
    @include('dashboard.layouts.packages.livewire.filter')
    <a href="{{ route('dashboard.products.create') }}" class="btn btn-danger d-flex align-items-center gap-2 w-100 w-md-auto justify-content-center order-1 order-md-3">
        <i class="bi bi-plus-circle"></i>
        @lang('Create') @lang('Products')
    </a>
@endsection

@section('content')
    @include('dashboard.product.products.filters')
    <div class="card shadow-sm">
        <div class="card-body">
            @livewire('dashboard.product.product-table')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    @include('dashboard.layouts.packages.livewire.loading')
@endpush
