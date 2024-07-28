{{-- notification message toast --}}
<script>
    Swal.fire({
        position: "top-end",
        icon: '{{ session('notification_color') }}',
        toast: true,
        title: '{{ session('msg') }}',
        showConfirmButton: false,
        timer: 3000
    });
</script>
