<script>
    // LIVEWIRE
    var target = document.querySelector("body");
    var blockUI = new KTBlockUI(target, {
        overlayClass: 'bg-dark bg-opacity-75 position-fixed',
        message: '<div class="blockui-message"><span class="spinner-border text-success"></span> @lang('Loading ...')</div>',
    });
    Livewire.hook('message.sent', (message, component) => {
        blockUI.block();
    });
    Livewire.hook('message.processed', (message, component) => {
        blockUI.release();
        refreshFsLightbox();
        KTMenu.createInstances();
    });

    // Notify
    window.addEventListener('notify', event => {
        $.notify({
            message: event.detail.message
        }, {
            type: 'success'
        });
    });
</script>
