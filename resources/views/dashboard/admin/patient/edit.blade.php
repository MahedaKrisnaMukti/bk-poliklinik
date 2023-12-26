@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Ubah Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/admin/pasien">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <form id="formSubmit" method="POST" action="/admin/pasien/{{ Crypt::encrypt($patient->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="mb-1">
                        <label class="form-label" for="email">
                            Email
                        </label>

                        <input type="text" class="form-control" name="email" id="email"
                            value="{{ $patient->user->email }}" placeholder="Masukan Email" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="password">
                            Password
                        </label>

                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Masukan Password" autocomplete="off">

                        <div class="form-check mt-1">
                            <input type="checkbox" class="form-check-input" id="changePassword">

                            <label class="form-check-label" for="changePassword">
                                Ubah Password
                            </label>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="name">
                            Nama
                        </label>

                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $patient->name }}" placeholder="Masukan Nama" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="address">
                            Alamat
                        </label>

                        <textarea class="form-control" name="address" id="address" placeholder="Masukan Alamat" cols="30" rows="5">{{ $patient->address }}</textarea>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="identity_card_number">
                            Nomer KTP
                        </label>

                        <input type="text" class="form-control" name="identity_card_number" id="identity_card_number"
                            value="{{ $patient->identity_card_number }}" onkeypress="return inputNumber()"
                            placeholder="Masukan Nama Pasien" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="phone_number">
                            Nomor HP
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                62
                            </span>

                            <input type="text" class="form-control" name="phone_number" id="phone_number"
                                value="{{ $patient->phone_number }}"" onkeypress="return inputNumber()" 
                                placeholder="Masukan Nomor HP" autocomplete="off">
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="medical_record_number">
                            No. RM
                        </label>

                        <input type="text" class="form-control" name="medical_record_number" id="medical_record_number"
                            value="{{ $patient->medical_record_number }}" placeholder="Masukan Nama Pasien"
                            autocomplete="off">
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
            const name = $('#name');
            const address = $('#address');
            const identity_card_number = $('#identity_card_number');
            const phone_number = $('#phone_number');
            const medical_record_number = $('#medical_record_number');

            if (name.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Nama pasien tidak boleh kosong !",
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

            if (identity_card_number.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Nomer KTP tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (phone_number.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "No.HP tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (medical_record_number.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "No.RM tidak boleh kosong !",
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
