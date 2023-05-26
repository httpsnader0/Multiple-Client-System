@extends('dashboard.layouts.app')

@section('title')
    @lang('Products')
@endsection

@section('breadcrumb')
    <li>@lang('Products')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.products.index') }}">@lang('Products')</a></li>
    <li>/</li>
    <li>@lang('Create')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.products.index') }}" class="btn btn-danger">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale()== 'ar' ? 'right' : 'left' }}"></i>
        @lang('Products')
    </a>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
        <div class="card-body pb-0">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12 mb-7 d-flex justify-content-center align-items-center flex-column">
                    <label>@lang('Cover')</label>
                    <div class="image-input d-flex flex-column">
                        <a data-fslightbox="cover" href="{{ asset('assets/default.png') }}" class="symbol symbol-150px my-3 bg-white border border-5 border-white rounded-4 shadow-sm overflow-hidden">
                            <img src="{{ asset('assets/default.png') }}">
                        </a>
                        <label class="btn btn-light btn-active-color-danger btn-icon w-100 position-relative translate-y-0 @error('cover') border border-danger @enderror" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-dismiss="click" title="@lang('Select Image')">
                            <i class="bi bi-upload"></i>
                            <input name="cover" type="file" accept=".png, .jpg, .jpeg, .gif, .webp" class="d-none" />
                        </label>
                    </div>
                    @error('cover')
                        <span class="invalid-feedback justify-content-center mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="accordion row justify-content-center" id="languageAccordion">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="col-md-6 mb-7">
                                <div class="accordion-item rounded">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button rounded rounded-bottom-0 gap-3 fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $localeCode }}" aria-expanded="true">
                                            <div class="symbol symbol-20px">
                                                <img src="{{ asset($properties['flag']) }}" alt="{{ $properties['native'] }}" />
                                            </div>
                                            {{ $properties['native'] }}
                                        </button>
                                    </h2>
                                    <div id="{{ $localeCode }}" class="accordion-collapse collapse show" data-bs-parent="#languageAccordion">
                                        <div class="accordion-body px-7 pt-7 pb-0">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 mb-7">
                                                    <label class="required">@lang('Name')</label>
                                                    <input name="name[{{ $localeCode }}]" value="{{ old('name.' . $localeCode) }}" type="text" class="form-control mt-3 @error('name.' . $localeCode) is-invalid @enderror">
                                                    @error('name.' . $localeCode)
                                                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-7">
                                                    <label class="required">@lang('Description')</label>
                                                    <input name="description[{{ $localeCode }}]" value="{{ old('description.' . $localeCode) }}" type="text" class="form-control mt-3 @error('description.' . $localeCode) is-invalid @enderror">
                                                    @error('description.' . $localeCode)
                                                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 mb-7">
                    <label class="required">@lang('Price')</label>
                    <input name="price" value="{{ old('price') }}" type="number" min="0.1" step="0.1" class="form-control mt-3 no-number-arrow @error('price') is-invalid @enderror">
                    @error('price')
                        <span class="invalid-feedback d-flex text-capitalize">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-danger w-100 w-lg-25">
                <span class="indicator-label">@lang('Create')</span>
                <span class="indicator-progress">@lang('Please Wait ...') <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
@endsection

@push('js')
    @include('dashboard.layouts.packages.files')
    <script>
        // IMAGE
        $('[name="cover"]').change(function() {
            filePreview(this);
        });
    </script>
@endpush
