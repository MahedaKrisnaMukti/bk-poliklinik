@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: "success",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1000
        });
    </script>
@endif

@if (session()->has('fail'))
    <script>
        Swal.fire({
            icon: "error",
            text: "{{ session('fail') }}",
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-gradient-primary',
            },
        });
    </script>
@endif

@if (session()->has('toast'))
    <script>
        iziToast.show({
            message: "{{ session('toast') }}",
            color: 'blue',
            position: 'topRight'
        });
    </script>
@endif
