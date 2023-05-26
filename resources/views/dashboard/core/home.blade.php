@extends('dashboard.layouts.app')

@section('title')
    @lang('Home Page')
@endsection

@section('content')
    @if (auth()->user()->type == App\Enums\UserTypeEnum::CLIENT())
        <div class="row g-7">
            @forelse ($products as $product)
                <div class="col-md-3">
                    <form action="{{ route('dashboard.products.buy', $product->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
                        @csrf
                        <div class="card-body d-flex gap-5 flex-column justify-content-center align-items-center text-center">
                            <img src="{{ $product->cover }}" alt="{{ $product->name }}" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px">
                            <span class="text-danger fw-bold fs-2">{{ $product->name }}</span>
                            <span class="text-muted">{{ Str::limit($product->description, '70', ' ...') }}</span>
                            <span class="text-success fw-bold fs-1">{{ $product->price }}</span>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger w-100">
                                <span class="indicator-label">@lang('Buy Product')</span>
                                <span class="indicator-progress">@lang('Please Wait ...') <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @lang('There Iis No Products Founded')
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                SOON
            </div>
        </div>
    @endif
@endsection
