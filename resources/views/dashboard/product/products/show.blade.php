@extends('dashboard.layouts.app')

@section('title')
    @lang('Products')
@endsection

@section('breadcrumb')
    <li>@lang('Products')</li>
    <li>/</li>
    <li><a href="{{ route('dashboard.products.index') }}">@lang('Products')</a></li>
    <li>/</li>
    <li>@lang('Show')</li>
@endsection

@section('actions')
    <a href="{{ route('dashboard.products.index') }}" class="btn btn-danger">
        <i class="bi bi-arrow-{{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'right' : 'left' }}"></i>
        @lang('Products')
    </a>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-row-bordered gy-5 gs-7 border table-rounded mb-0">
                    <tbody>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Cover')</th>
                            <td class="align-middle">
                                <a data-fslightbox href="{{ $product->cover }}" class="symbol symbol-150px my-3 bg-white border border-5 border-white rounded-4 shadow-sm overflow-hidden">
                                    <img src="{{ $product->cover }}">
                                </a>
                            </td>
                        </tr>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <tr>
                                <th class="align-middle text-nowrap py-7" width="30%">@lang('Name') ( <span class="text-muted">{{ $properties['native'] }}</span> )</th>
                                <td class="align-middle">{{ $product->getTranslation('name', $localeCode) }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-nowrap py-7" width="30%">@lang('Description') ( <span class="text-muted">{{ $properties['native'] }}</span> )</th>
                                <td class="align-middle">{{ $product->getTranslation('description', $localeCode) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Price')</th>
                            <td class="align-middle">{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Status')</th>
                            <td class="align-middle">
                                @if ($product->active == 1)
                                    <span class="badge badge-light-success fw-normal px-4 py-2 fs-7">@lang('Active')</span>
                                @elseif ($product->active == 0)
                                    <span class="badge badge-light-danger fw-normal px-4 py-2 fs-7">@lang('Inactive')</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Created At')</th>
                            <td class="align-middle">{!! dateTableFormat($product->created_at, '<br />', true, true) !!}</td>
                        </tr>
                        <tr>
                            <th class="align-middle text-nowrap py-7" width="30%">@lang('Updated At')</th>
                            <td class="align-middle">{!! dateTableFormat($product->updated_at, '<br />', true, true) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
