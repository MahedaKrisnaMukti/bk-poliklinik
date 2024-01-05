@extends('layouts.auth')

@section('content')
    <div class="card-header border-0">
        <div class="text-center mb-1">
            <img src="/assets/images-custom/logo.png" style="max-height: 80px">
        </div>

        <div class="font-large-1  text-center">
            Login
        </div>
    </div>

    <div class="card-content">
        <div class="card-body">
            <form id="formSubmit" method="POST" action="/authenticate" onsubmit="return validate()"
                enctype="multipart/form-data">
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
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Masukan Password" autocomplete="off">

                        <span class="input-group-text cursor-pointer">
                            <i class="ft-lock"></i>
                        </span>
                    </div>
                </div>

                <hr>

                <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                    <i class="bi bi-check2-circle"></i>
                    Login
                </button>
            </form>

            <div class="mt-1">
                <p class="text-center">
                    <span>
                        Belum punya akun ?
                    </span>

                    <a href="/registrasi">
                        <span>
                            Registrasi
                        </span>
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        function validate() {
            const email = $('#email');
            const password = $('#password');

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

            return true;
        }
    </script>
@endsection
