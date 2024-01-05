@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <form id="formSubmit" method="POST" action="/dokter/daftar-pasien/{{ Crypt::encrypt($poliRegister->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Ubah Data
                    </h4>
                </div>

                <div class="card-body">
                    <div class="mb-1">
                        <a href="/dokter/daftar-pasien">
                            <button type="button" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <input type="hidden" id="patientId" value="{{ $poliRegister->patient_id }}">

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
                </div>
            </div>

            <div class="mb-1">
                <div class="row">
                    @foreach ($medicine as $row)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ $row->image_url }}" class="card-img-top card-image" loading="lazy">

                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ $row->name }}

                                        <br>

                                        @php
                                            $qty = 0;

                                            foreach ($cart as $rowCart) {
                                                if ($row->id == $rowCart['attributes']['id_original']) {
                                                    $qty = $rowCart['quantity'];
                                                }
                                            }
                                        @endphp

                                        <input type="hidden" id="medicine{{ $row->id }}" value="{{ $qty }}">

                                        <span class="badge bg-success mt-1" id="medicine-text{{ $row->id }}">
                                            {{ $qty }}
                                        </span>
                                    </h3>

                                    <h4 class="card-text mb-1">
                                        {{ FormatterCustom::formatNumber($row->price, true) }}
                                    </h4>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-warning"
                                            onclick="addMedicine({{ $row->id }})">
                                            <i data-feather="plus-square"></i>
                                            Tambah
                                        </button>

                                        <button type="button" class="btn btn-danger"
                                            onclick="removeMedicine({{ $row->id }})">
                                            <i data-feather="x"></i>
                                            Hapus
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="mb-1">
                        <label class="form-label" for="note">
                            Catatan
                        </label>

                        <textarea class="form-control" name="note" id="note" placeholder="Masukan Catatan" autocomplete="off"
                            cols="30" rows="5">{{ $checkup ? $checkup->note : '' }}</textarea>
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

                    <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                        <i class="bi bi-check2-circle"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </form>

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

        async function addMedicine(id) {
            const patientId = $('#patientId').val();

            await axios({
                method: "post",
                url: "/dokter/daftar-pasien/tambah-obat",
                headers: {
                    "Content-Type": "multipart/form-data",
                },
                data: {
                    id: id,
                    patientId: patientId,
                    _token: "{{ csrf_token() }}",
                },
            }).then(function(res) {
                const response = res.data;

                if (response.status) {
                    const qtyMedicine = $('#medicine' + id).val();

                    $('#medicine' + id).val(Number(qtyMedicine) + 1);
                    $('#medicine-text' + id).html(Number(qtyMedicine) + 1);

                    iziToast.show({
                        message: response.message,
                        color: 'blue',
                        position: 'topRight'
                    });
                }
            });
        }

        async function removeMedicine(id) {
            const qtyMedicine = $('#medicine' + id).val();

            if (Number(qtyMedicine) > 0) {
                const patientId = $('#patientId').val();

                await axios({
                    method: "post",
                    url: "/dokter/daftar-pasien/hapus-obat",
                    data: {
                        id: id,
                        patientId: patientId,
                        _token: "{{ csrf_token() }}",
                    },
                }).then(function(res) {
                    const response = res.data;

                    if (response.status) {
                        const qtyMedicine = $('#medicine' + id).val();

                        $('#medicine' + id).val(Number(qtyMedicine) - 1);
                        $('#medicine-text' + id).html(Number(qtyMedicine) - 1);

                        iziToast.show({
                            message: response.message,
                            color: 'blue',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

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
