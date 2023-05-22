<div id="kt_app_footer" class="app-footer">
    <div class="app-container container-fluid d-flex flex-column align-items-center p-5 flex-md-row justify-content-md-between" style="direction: ltr">
        <div class="order-1 d-flex align-items-center mb-2">
            <a href="{{ route('dashboard.index') }}">
                <img alt="{{ env('APP_NAME') }}" src="{{ asset(Setting::get('icon')) }}" class="mh-20px" />
            </a>
            <span class="mx-5 fs-7 text-gray-600 pt-1">
                Multiple Client System © 2023
            </span>
        </div>
        <div class="order-2 fs-7 mb-md-0 text-muted">
            Made With
            <span class="svg-icon svg-icon-danger svg-icon-4 mx-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z" fill="currentColor"></path>
                </svg>
            </span>
            By
            <a href="https://fb.com/httpsnader0" target="_blank" class="mx-1">Mohamed Nader</a>
        </div>
    </div>
</div>