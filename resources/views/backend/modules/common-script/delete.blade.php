<script>
    /* @sweetalart during delete */
    $('.delete').on('click', function() {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure to delete?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#form_${id}`).submit()
            }
        });
    });
</script>
