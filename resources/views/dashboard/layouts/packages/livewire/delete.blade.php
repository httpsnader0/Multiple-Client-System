<div class="menu-item px-3">
    <a onclick="Delete('{{ route($route . '.destroy', $id) }}')" class="btn btn-icon btn-active-color-success w-100 menu-link px-5 py-5 d-flex justify-content-start align-items-center gap-3 fs-7 text-nowrap">
        <i class="bi bi-trash3"></i>
        @lang('Delete')
    </a>
</div>

<script>
    function Delete(getRoute) {
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
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        Livewire.emit('refresh')
                        $.notify({
                                message: '@lang('Deleted Successfully')',
                        }, {
                            type: 'success',
                        });
                    }
                });
            }
        });
    }
</script>

