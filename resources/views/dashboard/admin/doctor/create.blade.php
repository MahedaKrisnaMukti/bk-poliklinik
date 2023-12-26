@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Tambah Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/admin/dokter">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <form id="formSubmit" method="POST" action="/admin/dokter" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-1">
                        <label class="form-label" for="email">
                            Email
                        </label>

                        <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email"
                            autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="password">
                            Password
                        </label>

                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Masukan Password" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="poliId">
                            Poli
                        </label>

                        <select class="form-control select2" name="poliId" id="poliId">
                            <option value="">
                                Pilih salah satu
                            </option>

                            @foreach ($poli as $row)
                                <option value="{{ $row->id }}">
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="name">
                            Nama
                        </label>

                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Masukan Nama Dokter" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="address">
                            Alamat
                        </label>

                        <textarea class="form-control" name="address" id="address" placeholder="Masukan Alamat" cols="30" rows="5"></textarea>
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
                        Simpan
                    </button>
                </form>
            </div>
        </div>
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
            const poliId = $('#poliId');
            const name = $('#name');
            const address = $('#address');
            const phoneNumber = $('#phoneNumber');

            if (email.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Email poli tidak boleh kosong !",
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

            if (poliId.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Pilih poli terlebih dahulu !",
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
