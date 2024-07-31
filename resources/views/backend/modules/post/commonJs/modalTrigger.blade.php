@push('js')
    <script>
        /* @image modal open */
        $('.post-image').on('click', function() {

            let image = $(this).attr('data-src');
            $('#display_image').attr('src', image);
            $('#img_show_btn').trigger('click');

        })
    </script>
@endpush
