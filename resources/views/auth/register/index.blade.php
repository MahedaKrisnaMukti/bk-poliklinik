@extends('layouts.auth')

@section('content')
    <h4 class="mb-1 pt-2 d-flex justify-content-center">
        Registrasi Pasien
    </h4>

    <form id="formSubmit" method="POST" action="/registration" enctype="multipart/form-data">
        @csrf

        <div class="mb-2">
            <label class="form-label" for="email">
                Email
            </label>

            <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email"
                autocomplete="off">
        </div>

        <div class="mb-2">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">
                    Password
                </label>
            </div>

            <div class="input-group form-password-toggle">
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password"
                    autocomplete="off">

                <span class="input-group-text cursor-pointer">
                    <i data-feather="eye"></i>
                </span>
            </div>
        </div>

        <div class="mb-2">
            <label class="form-label" for="name">
                Nama
            </label>

            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama"
                autocomplete="off">
        </div>

        <div class="mb-1">
            <label class="form-label" for="address">
                Alamat
            </label>

            <textarea class="form-control" name="address" id="address" placeholder="Masukan Alamat" cols="30" rows="5"></textarea>
        </div>

        <div class="mb-2">
            <label class="form-label" for="identityCardNumber">
                Nomor KTP
            </label>

            <input type="text" class="form-control" name="identityCardNumber" id="identityCardNumber"
                onkeypress="return inputNumber()" placeholder="Masukan Nomor KTP" autocomplete="off">
        </div>

        <div class="mb-1">
            <label class="form-label" for="phoneNumber">
                Nomor HP
            </label>

            <div class="input-group">
                <span class="input-group-text">
                    62
                </span>

                <input type="text" class="form-control" name="phoneNumber" id="phoneNumber"
                    onkeypress="return inputNumber()" placeholder="Masukan Nomor HP" autocomplete="off">
            </div>
        </div>

        <hr>

        <button type="submit" class="btn btn-gradient-primary w-100" id="btnSubmit">
            <i class="bi bi-check2-circle"></i>
            Registrasi
        </button>
    </form>

    <div class="mt-1">
        <p class="text-center">
            <span>
                Sudah punya akun ?
            </span>

            <a href="/login">
                <span>
                    Login
                </span>
            </a>
        </p>
    </div>
@endsection

@section('custom_js')
    <script>
        $('#formSubmit').submit(function(e) {
            let status = validate();
            let form = this;
            e.preventDefault();

            if (status) {
                confirmSubmit(form);
            }
        });

        function validate() {
            const email = $('#email');
            const password = $('#password');
            const name = $('#name');
            const address = $('#address');
            const identityCardNumber = $('#identityCardNumber');
            const phoneNumber = $('#phoneNumber');

            if (email.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Email tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (!isEmail(email.val())) {
                Swal.fire({
                    icon: "error",
                    text: "Format email tidak valid !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (password.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Password tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (name.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Nama dokter tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (address.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Alamat tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (identityCardNumber.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Nomor KTP tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (phoneNumber.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Nomor HP tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            return true;
        }
    </script>
@endsection
