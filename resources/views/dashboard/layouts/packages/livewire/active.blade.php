<button onclick="Active('{{ route($route . '.active', $id) }}')" type="button" class="btn @if ($active == 0) btn-light-danger @elseif ($active == 1) btn-light-success @endif px-4 py-2 fs-7 text-nowrap">
    @if ($active == 0)
        @lang('Inactive')
    @elseif ($active == 1)
        @lang('Active')
    @endif
</button>

<script>
    function Active(getRoute) {
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
                        if (response.active == 0) {
                            $.notify({
                                message: '@lang('Inactived Successfully')',
                            }, {
                                type: 'success',
                            });
                        } else if (response.active == 1) {
                            $.notify({
                                message: '@lang('Actived Successfully')',
                            }, {
                                type: 'success',
                            });
                        }
                    }
                });
            }
        });
    }
</script>
