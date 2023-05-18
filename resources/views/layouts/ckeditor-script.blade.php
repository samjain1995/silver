<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('ckeditor', {
        pasteFilter: false,
        specialChars: false,
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        disallowedContent: 'img{width,height};',
        on: {
            instanceReady: function() {
                this.dataProcessor.htmlFilter.addRules({
                    elements: {
                        img: function(el) {
                            // Add an attribute.
                            if (!el.attributes.alt)
                                el.attributes.alt = 'Image';
                            // Add some class.
                            el.addClass('img-fluid');
                        }
                    }
                });
            }
        }
    });
    CKEDITOR.config.allowedContent = true;
</script>
