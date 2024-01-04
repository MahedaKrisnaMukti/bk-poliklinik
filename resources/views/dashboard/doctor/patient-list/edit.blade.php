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
                    <a href="/dokter/daftar-pasien">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <form id="formSubmit" method="POST" action="/dokter/daftar-pasien/{{ Crypt::encrypt($poliRegister->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="mb-1">
                        <label class="form-label" for="name">
                            Nama
                        </label>

                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $poliRegister->patient->name }}" placeholder="Masukan Nama" autocomplete="off"
                            readonly>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="complaint">
                            Keluhan
                        </label>

                        <textarea class="form-control" name="complaint" id="complaint" placeholder="Masukan Keluhan" autocomplete="off"
                            cols="30" rows="5" readonly>{{ $poliRegister->complaint }}</textarea>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="note">
                            Catatan
                        </label>

                        <textarea class="form-control" name="note" id="note" placeholder="Masukan Catatan" autocomplete="off"
                            cols="30" rows="5"></textarea>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="medicineId">
                            Obat
                        </label>

                        <select class="form-control select2" name="medicineId" id="medicineId">
                            <option value="">
                                Pilih salah satu
                            </option>
                            
                            @foreach ($medicine as $row)
                                <option value="{{ $row->id }}">
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="poliRegisterDate">
                            Tanggal Periksa
                        </label>

                        <input type="text" class="form-control" name="poliRegisterDate" id="poliRegisterDate"
                            value="{{ FormatterCustom::formatDate($poliRegister->poli_register_date) }}"
                            placeholder="Masukan Tanggal Periksa" autocomplete="off" readonly>
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
            const note = $('#note');
            const medicineId = $('#medicineId');

            if (note.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Catatan tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (medicineId.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Pilih obat terlebih dahulu !",
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
