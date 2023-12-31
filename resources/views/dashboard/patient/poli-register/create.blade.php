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
                    <a href="/pasien/mendaftar-poli">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <form id="formSubmit" method="POST" action="/pasien/mendaftar-poli" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-1">
                        <label class="form-label" for="poliId">
                            Poli
                        </label>

                        <select class="form-control select2" name="poliId" id="poliId"
                            onchange="checkCheckupSchedule()">
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
                        <label class="form-label" for="poliRegisterDate">
                            Tanggal
                        </label>

                        <input type="text" class="form-control custom-datepicker" name="poliRegisterDate"
                            id="poliRegisterDate" onchange="checkCheckupSchedule()" placeholder="Masukan Tanggal"
                            autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="checkupScheduleId">
                            Jadwal Periksa
                        </label>

                        <select class="form-control select2" name="checkupScheduleId" id="checkupScheduleId">
                            <option value="">
                                Pilih poli dan tanggal terlebih dahulu
                            </option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="complaint">
                            Keluhan
                        </label>

                        <textarea class="form-control" name="complaint" id="complaint" placeholder="Masukan Keluhan" autocomplete="off"
                            cols="30" rows="5"></textarea>
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
        async function checkCheckupSchedule() {
            const poliId = $('#poliId');
            const poliRegisterDate = $('#poliRegisterDate');

            $('#checkupScheduleId').html(`
                <option value="">
                    Pilih poli dan tanggal terlebih dahulu
                </option>
            `);

            if ((poliId.val() != '') && (poliRegisterDate.val() != '')) {
                await axios({
                    method: "get",
                    url: "/pasien/mendaftar-poli/cek-jadwal-periksa",
                    params: {
                        poliId: poliId.val(),
                        poliRegisterDate: poliRegisterDate.val(),
                    },
                }).then(function(res) {
                    const response = res.data;
                    const checkupSchedule = response.checkupSchedule;

                    if (checkupSchedule.length > 0) {
                        let element = '';

                        checkupSchedule.forEach(row => {
                            const startTime = row.start_time;
                            const endTime = row.end_time;
                            const doctor = row.doctor;

                            const elementLoop = `
                                <option value="${row.id}">
                                    ${startTime} - ${endTime} (${doctor.name})
                                </option>
                            `;

                            element = element + elementLoop;
                        });

                        $('#checkupScheduleId').html(element)
                    } else {
                        $('#checkupScheduleId').html(`
                            <option value="">
                                Jadwal tidak tersedia
                            </option>
                        `);
                    }
                });
            }

        }

        $('#formSubmit').submit(function(e) {
            let status = validate();
            let form = this;
            e.preventDefault();

            if (status) {
                confirmSubmit(form);
            }
        });

        function validate() {
            const poliId = $('#poliId');
            const poliRegisterDate = $('#poliRegisterDate');
            const checkupScheduleId = $('#checkupScheduleId');
            const complaint = $('#complaint');

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

            if (poliRegisterDate.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Tanggal tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (checkupScheduleId.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Pilih jadwal periksa terlebih dahulu !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (complaint.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Keluhan tidak boleh kosong !",
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
