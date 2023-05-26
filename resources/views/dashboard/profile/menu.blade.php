<div class="card mb-5 mb-xl-10 shadow-sm">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-column flex-md-row justify-content-center mb-3">
            <div class="me-0 me-md-7 mb-4 w-100 w-md-auto text-center text-md-start">
                <a data-fslightbox href="{{ auth()->user()->profile }}" class="symbol symbol-100px symbol-md-200px symbol-fixed position-relative">
                    <img src="{{ auth()->user()->profile }}" alt="{{ auth()->user()->name }}" class="rounded-circle">
                </a>
            </div>
            <div class="flex-grow-1 d-flex flex-column justify-content-center">
                <div class="d-flex flex-column text-center text-md-start mb-10">
                    <span class="text-danger fs-2 mb-2">{{ auth()->user()->name }}</span>
                    <div class="text-gray-400 fs-6">
                        <span class="d-inline-block">{{ auth()->user()->phone }}</span>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start">
                    <div class="border border-gray-300 border-dashed rounded min-w-100 min-w-md-150px p-4 me-0 me-md-6 mb-3 text-center text-md-start">
                        <div class="fw-semibold fs-5 text-gray-400 mb-2">@lang('Created At')</div>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start fs-7 fw-bold">{!! dateTableFormat(auth()->user()->created_at) !!}</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-100 min-w-md-150px p-4 me-0 me-md-6 mb-3 text-center text-md-start">
                        <div class="fw-semibold fs-5 text-gray-400 mb-2">@lang('Updated At')</div>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start fs-7 fw-bold">{!! dateTableFormat(auth()->user()->updated_at) !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent">
            <li class="nav-item w-100 w-md-auto">
                <a id="profileProfilePage" href="{{ route('dashboard.profile.index') }}" class="nav-link text-active-danger text-hover-danger ms-0 me-0 me-md-10 w-100 w-md-auto py-5 px-10 justify-content-center border-hover-danger">
                    @lang('Profile Page')
                </a>
            </li>
            <li class="nav-item w-100 w-md-auto">
                <a id="profileChangePassword" href="{{ route('dashboard.profile.change-passwords.index') }}" class="nav-link text-active-danger text-hover-danger ms-0 me-0 me-md-10 w-100 w-md-auto py-5 px-10 justify-content-center border-hover-danger">
                    @lang('Change Password')
                </a>
            </li>
        </ul>
    </div>
</div>
