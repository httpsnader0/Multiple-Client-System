<div id="filterCollapse" class="collapse @if (isset(optional(request()->get('table'))['filters'])) show @endif">
    <div class="card shadow-sm mb-7">
        <div class="card-header px-7">
            <h3 class="card-title d-flex align-items-center gap-3">
                <i class="bi bi-funnel"></i>
                @lang('Filters')
            </h3>
            <div class="card-toolbar">
                <button type="button" onclick="resetFilters()" class="btn btn-sm btn-light-danger">@lang('Reset Filters')</button>
            </div>
        </div>
        <div class="card-body p-7 pb-0 row justify-content-center">
            <div class="col-md-4 mb-7">
                <label>@lang('Status')</label>
                <select name="active" data-control="select2" data data-placeholder="&nbsp;" data-hide-search="true" class="form-select mt-3">
                    <option></option>
                    <option value="1">@lang('Active')</option>
                    <option value="0">@lang('Inactive')</option>
                </select>
            </div>
            <div class="col-md-4 mb-7">
                <label>@lang('Created At')</label>
                <input name="date" type="text" class="form-control mt-3 createdAtPicker" />
            </div>
            <div class="col-md-4 mb-7">
                <label>@lang('Roles')</label>
                <select name="role" data-control="select2" data data-placeholder="&nbsp;" class="form-select mt-3">
                    <option></option>
                    @foreach ($roles as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

@push('js')
    @if (LaravelLocalization::getCurrentLocale()== 'ar')
        <script src="{{ asset('assets/packages/flatpicker/ar.js') }}"></script>
    @endif
    <script>
        // RESET FILTERS
        function resetFilters(filterKey = '') {
            if (filterKey == 'active' || filterKey == '') {
                $('[name="active"]').val(null).change();
                Livewire.emit('filterByActive', null);
            }
            if (filterKey == 'createdAt' || filterKey == '') {
                $('.createdAtPicker')[0]._flatpickr.clear();
                Livewire.emit('filterByCreatedAt', null);
            }
            if (filterKey == 'role' || filterKey == '') {
                $('[name="role"]').val(null).change();
                Livewire.emit('filterByRole', null);
            }
        }

        // ACTIVE FILTER
        $('[name="active"]').val('{{ optional(optional(request()->get('table'))['filters'])['active'] }}').change();
        $('[name="active"]').on('change', function() {
            Livewire.emit('filterByActive', $(this).val());
        });

        // CREATED AT FILTER
        $('.createdAtPicker').flatpickr({
            mode: 'range',
            dateFormat: 'Y/m/d',
            position: 'auto center',
            defaultDate: ['{{ Str::before(optional(optional(request()->get('table'))['filters'])['createdAt'], ' - ') }}', '{{ Str::after(optional(optional(request()->get('table'))['filters'])['createdAt'], ' - ') }}'],
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length == 2) {
                    Livewire.emit('filterByCreatedAt', [
                        new Date(selectedDates[0]).toLocaleDateString('en-US'),
                        new Date(selectedDates[1]).toLocaleDateString('en-US'),
                    ]);
                }
            },
            @if (LaravelLocalization::getCurrentLocale()== 'ar')
                locale: 'ar',
            @endif
        });

        // ROLE FILTER
        $('[name="role"]').val('{{ optional(optional(request()->get('table'))['filters'])['role'] }}').change();
        $('[name="role"]').on('change', function() {
            Livewire.emit('filterByRole', $(this).val());
        });
    </script>
@endpush
