@if ($claimed == 0)
    <button onclick="Claim('{{ route($route . '.claim', $id) }}')" type="button" class="btn btn-light-danger px-4 py-2 fs-7 text-nowrap">
        @lang('Unclaimed')
    </button>
@elseif ($claimed == 1)
    <span class="badge badge-light-success fw-normal px-4 py-2 fs-7 text-nowrap">@lang('Claimed')</span>
@endif

<script>
    function Claim(getRoute) {
        Swal.fire({
            title: '@lang('Are You Sure')',
            text: '@lang('If You Confirm We Will Not Able To Back Again')',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '@lang('Confirm')',
            cancelButtonText: '@lang('Cancel')',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: getRoute,
                    type: 'POST',
                    data: {
                        _method: 'PUT',
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        Livewire.emit('refresh')
                        $.notify({
                            message: response.error ?? '@lang('Claimed Successfully')',
                        }, {
                            type: response.error ? 'danger' : 'success',
                        });
                    }
                });
            }
        });
    }
</script>
