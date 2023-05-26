<script>
    $('.dateRangePicker').daterangepicker({
        autoApply: false,
        autoUpdateInput: false,
        opens: "center",
        drops: "auto",
        buttonClasses: "btn btn-sm",
        applyButtonClasses: "btn-light-danger",
        ranges: {
            '@lang('Today')': [moment(), moment()],
            '@lang('Yesterday')': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '@lang('Last 7 Days')': [moment().subtract(6, 'days'), moment()],
            '@lang('Last 30 Days')': [moment().subtract(29, 'days'), moment()],
            '@lang('This Month')': [moment().startOf('month'), moment().endOf('month')],
            '@lang('Last Month')': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        },
        locale: {
            firstDay: 6,
            direction: '@lang('ltr')',
            format: '@lang('DD/MM/YYYY')',
            separator: ' - ',
            applyLabel: '@lang('Apply')',
            cancelLabel: '@lang('Cancel')',
            fromLabel: '@lang('From')',
            toLabel: '@lang('To')',
            customRangeLabel: '@lang('Custom Date')',
            daysOfWeek: [
                '@lang('Su')',
                '@lang('Mo')',
                '@lang('Tu')',
                '@lang('We')',
                '@lang('Th')',
                '@lang('Fr')',
                '@lang('Sa')'
            ],
            monthNames: [
                '@lang('January')',
                '@lang('February')',
                '@lang('March')',
                '@lang('April')',
                '@lang('May')',
                '@lang('June')',
                '@lang('July')',
                '@lang('August')',
                '@lang('September')',
                '@lang('October')',
                '@lang('November')',
                '@lang('December')'
            ],
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        @if (LaravelLocalization::getCurrentLocale()== 'ar')
            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
        @else
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        @endif
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>
