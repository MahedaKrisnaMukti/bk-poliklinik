<script>
    $(document).ready(function() {
        loadDatepicker();
        loadDropify();
        loadSelect2();
    });
</script>

<script>
    function loadDatepicker() {
        if ($('.datepicker').length) {
            $(".datepicker").flatpickr({
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d"
            });
        }
    }

    function loadDropify() {
        if ($('.dropify').length) {
            let message = '<span class="dropify-message-custom">Klik atau taruh file disini</span>';

            $('.dropify').dropify({
                messages: {
                    'default': message,
                    'replace': message,
                    'remove': 'Hapus',
                    'error': ''
                },
                error: {
                    'fileSize': 'Ukuran file terlalu besar (maksimal 5MB) !',
                    'fileExtension': 'Format file tidak diizinkan (hanya boleh jpg, jpeg, png) !',
                }
            });
        }
    }

    function loadSelect2() {
        if ($('.select2').length) {
            $('.select2').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
            });
        }
    }

    function previewImage(image) {
        Swal.fire({
            imageUrl: image,
            imageWidth: 400,
            imageHeight: 400,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-gradient-primary',
            },
        })
    }

    function loadingScreen(text) {
        if (!text) {
            text = 'Loading...';
        }

        Swal.fire({
            icon: 'info',
            text: text,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });
    }

    function confirmSubmit(form) {
        Swal.fire({
            icon: 'question',
            text: 'Apakah anda yakin ingin menyimpan data ini ?',
            showCancelButton: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-gradient-primary',
                cancelButton: 'btn btn-gradient-secondary margin-cancel-button',
            },
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                let loading =
                    `<span class="text-white spinner-border blockUiSpinner" role="status" aria-hidden="true"></span> 

                    <span class="text-white blockUiMessage">
                        Simpan
                    </span>`;

                $('#btnSubmit').attr('disabled', 'disabled');
                $('#btnSubmit').html(loading);
                form.submit();
            }
        });
    }

    function confirmDelete(id) {
        Swal.fire({
            icon: 'question',
            text: 'Apakah anda yakin ingin menghapus data ini ?',
            showCancelButton: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-gradient-danger',
                cancelButton: 'btn btn-gradient-secondary margin-cancel-button',
            },
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                let loading = 'Menghapus'
                let url = $('#formDelete').attr('action');
                url = url + id;

                loadingScreen(loading);
                $('#formDelete').attr('action', url);
                $("#formDelete").submit();
            }
        });
    }

    function isEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function inputNumber() {
        return /[0-9]/i.test(event.key);
    }

    function formatNumber(element) {
        let name = element.name;
        let number = element.value;

        number = number.toString();
        number = number.replace(/[^,\d]/g, '').toString();

        let split = number.split(',');
        let temp = split[0].length % 3;

        number = split[0].substr(0, temp);

        let thousand = split[0].substr(temp).match(/\d{3}/gi);

        if (thousand) {
            let separator = temp ? '.' : '';
            number += separator + thousand.join('.');
        }

        number = split[1] != undefined ? number + ',' + split[1] : number;

        $(`input[name="${name}"]`).val(number);
    }
</script>
