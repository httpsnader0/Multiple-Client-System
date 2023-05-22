<script src="{{ asset('assets/packages/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script>
    // NOTIFY
    $.notifyDefaults({
        type: 'success',
        allow_dismiss: true,
        newest_on_top: true,
        mouse_over: false,
        showProgressbar: false,
        @if (LaravelLocalization::getCurrentLocale()== 'ar')
            placement: {
                from: 'bottom',
                align: 'left'
            },
            animate: {
                enter: 'animate__animated animate__fadeInLeftBig',
                exit: 'animate__animated animate__fadeOutLeftBig',
            },
        @else
            placement: {
                from: 'bottom',
                align: 'right'
            },
            animate: {
                enter: 'animate__animated animate__fadeInRightBig',
                exit: 'animate__animated animate__fadeOutRightBig',
            },
        @endif
        spacing: 10,
        offset: 20,
        timer: 1000,
        delay: 2000,
        z_index: 99999,
    });
    @if (session('alert-message'))
        $.notify({
            message: '{{ session('alert-message') }}',
        }, {
            type: '{{ session('alert-type') }}',
        });
    @endif

    // DATEPICKER
    flatpickr.l10ns.default.firstDayOfWeek = 6;
    flatpickr.l10ns.default.rangeSeparator = ' - ';
</script>
