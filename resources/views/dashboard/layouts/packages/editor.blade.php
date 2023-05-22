<script>
    tinymce.init({
        selector: '.editor',
        plugins: 'preview searchreplace autolink directionality visualblocks visualchars image link media table hr lists emoticons quickbars',
        menubar: 'file edit insert format',
        menu: {
            file: {
                title: 'File',
                items: 'newdocument restoredraft | preview'
            },
            edit: {
                title: 'Edit',
                items: 'undo redo | cut copy paste | selectall | searchreplace'
            },
            insert: {
                title: 'Insert',
                items: 'link image media inserttable | emoticons hr'
            },
            format: {
                title: 'Format',
                items: 'bold italic underline strikethrough | fontformats fontsizes align | forecolor backcolor | removeformat'
            },
        },
        toolbar: 'fontsizeselect forecolor backcolor bold italic underline strikethrough | alignleft aligncenter alignright outdent indent | numlist bullis | link quickimage media quicktable | charmap emoticons | undo redo removeformat preview',
        toolbar_mode: 'sliding',
        quickbars_selection_toolbar: 'fontsizeselect forecolor backcolor bold italic underline strikethrough',
        statusbar: false,
        fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt 60pt',
        quickbars_insert_toolbar: false,
        video_template_callback: function(data) {
            return '<video width="' + data.width + '" height="' + data.height + '"' + (data.poster ? ' poster="' + data.poster + '"' : '') + ' controls="controls">\n' + '<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</video>';
        },
        @if (LaravelLocalization::getCurrentLocale()== 'ar')
            directionality: 'rtl',
            language: 'ar',
            language_url : '{{ asset('assets/plugins/custom/tinymce/plugins/lang/ar.js') }}',
        @endif
        media_dimensions: false,
        media_filter_html: false,
        media_poster: false,
    });
</script>
